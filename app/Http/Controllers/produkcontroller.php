<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produk;
use App\Models\kategori;
use App\Models\HistoriOpname;
use App\Models\StokMasuk;
use App\Models\StokHistori;
use App\Models\StokKeluar;
use App\Models\StokOpname;
use App\Models\ModalAwal;
use TCPDF;

class produkcontroller extends Controller
{
    public function index()
    {
         $dataproduk = Produk::with('kategori')->get();
         $kategoris = kategori::all();

    $totalLaba = $dataproduk->sum(function ($p) {
        return ($p->harga_jual - $p->harga_kolak) * $p->stok;
    });

    $totalModal = $dataproduk->sum(function ($p) {
        return $p->harga_kolak * $p->stok;
    });

    return view('dashboard_admin.produk.index', compact('dataproduk', 'kategoris', 'totalLaba', 'totalModal'));
    }
    public function order()
    {
        $dataproduk = produk::all();
        return view('order', compact('dataproduk'));
    }
    public function create()
    {
        $kategori = kategori::all();
        return view('dashboard_admin.Produk.create', compact('kategori'));
    }
    public function store(Request $request)
    {
        $data = new produk();
        $data->nama_produk = $request->nama_produk;
        $data->kategori_id = $request->kategori;
        $data->harga_kolak = $request->harga_kolak; // baru
        $data->harga_jual = $request->harga_jual;   // baru
        $data->stok = $request->stok;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'images/' . $filename;
            $file->move(public_path('images'), $filename);
            $data->foto = $path;
        }

        $data->save();
        return redirect('/tampil-produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = produk::find($id);
        $kategoris = kategori::all();
        return view('dashboard_admin.Produk.edit', ['data' => $data, 'kat' => $kategoris]);
    }
    public function update(Request $request, $id)
    {
        $data = produk::find($id);
        $data->nama_produk = $request->nama_produk;
        $data->kategori_id = $request->kategori;
        $data->harga_kolak = $request->harga_kolak; // baru
        $data->harga_jual = $request->harga_jual;   // baru

        if ($request->hasFile('foto')) {
            if ($data->foto && file_exists(public_path($data->foto))) {
                unlink(public_path($data->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'images/' . $filename;
            $file->move(public_path('images'), $filename);
            $data->foto = $path;
        }

        $data->update();
        return redirect('/tampil-produk')->with('success', 'Produk berhasil diubah');
    }

    public function destroy($id)
    {
        $data = produk::find($id);
        $data->delete();
        return redirect('/tampil-produk')->with('success', 'Produk berhasil dihapus');
    }

    public function indexStokMasuk()
    {
        $historiStokMasuk = StokHistori::all();
        $StokMasuk = StokMasuk::all();

        return view('dashboard_admin.Produk.stokMasuk', compact('historiStokMasuk', 'StokMasuk'));
    }

    public function indexStokKeluar()
    {
        $historiStokKeluar = StokHistori::with('detailStokKeluar.produk')->get();
        
        // Filter hanya stok keluar
        $stokKeluarData = $historiStokKeluar->where('tipe', 'Stok Keluar');
        
        // Hitung statistik untuk stok keluar
        $totalTransaksi = $stokKeluarData->count();
        $totalItem = $stokKeluarData->sum(function($histori) {
            return $histori->detailStokKeluar->sum('qty');
        });
        $totalNilai = $stokKeluarData->sum(function($histori) {
            return $histori->detailStokKeluar->sum('total');
        });

        return view('dashboard_admin.Produk.stokKeluar', compact(
            'historiStokKeluar', 
            'totalTransaksi', 
            'totalItem', 
            'totalNilai'
        ));
    }

    public function indexStokOpname()
    {
        $historiStokOpname = HistoriOpname::all();
        $StokOpname = StokOpname::all();

        return view('dashboard_admin.Produk.stokOpname', compact('historiStokOpname', 'StokOpname'));
    }

    public function indexStokMasukForm()
    {
        return view('dashboard_admin.Produk.formStok');
    }

    public function indexStokKeluarForm()
    {
        return view('dashboard_admin.Produk.formStokKeluar');
    }

    public function indexStokOpnameForm()
    {
        $produkList = produk::all();
        return view('dashboard_admin.Produk.formStokOpname', compact('produkList'));
    }

    public function stokMasukSearch(Request $request)
    {
        $query = $request->get('query');
        
        $produk = Produk::where('nama_produk', 'like', "%{$query}%")->get();

        if ($produk->isEmpty()) {
            return '<div class="list-group-item text-muted">Produk tidak ditemukan</div>';
        }

        $html = '';
        foreach ($produk as $item) {
            $html .= '<div class="list-group-item produk-item" data-id="'.$item->id.'" data-harga="'.($item->harga_beli ?? 0).'">'.$item->nama_produk.'</div>';
        }
        
        return $html; // Langsung return HTML, bukan JSON
    }

    public function stokMasukStore(Request $request)
    {
        $validated = $request->validate([
            'produk_id'  => 'required|array',
            'harga'      => 'required|array',
            'qty'        => 'required|array',
            'created_at'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil modal kulak dari ModalAwal terakhir
        // $modalAwal = ModalAwal::orderBy('tanggal', 'desc')->first();
        // $modalKulak = $modalAwal ? $modalAwal->modal_kulak : 0;

        // // Hitung total stok masuk yang akan ditambah
        // $totalStokMasuk = 0;
        // for ($i = 0; $i < count($validated['produk_id']); $i++) {
        //     $qty      = $validated['qty'][$i];
        //     $harga    = $validated['harga'][$i];
        //     $totalStokMasuk += $qty * $harga;
        // }

        // // Hitung total stok masuk yang sudah pernah ditambah
        // $totalStokMasukSebelumnya = DB::table('stok_masuk')->sum('total');

        // // Validasi: total stok masuk tidak boleh melebihi modal kulak
        // if (($totalStokMasukSebelumnya + $totalStokMasuk) > $modalKulak) {
        //     return redirect()->back()->with('error', 'Stok masuk melebihi batas modal kulak yang di-set owner!');
        // }

        $histori = StokHistori::create([
            'keterangan' => $validated['keterangan'] ?? 'TIdak ada keterangan',
            'tipe' => 'Stok Masuk',
            'created_at' => $validated['created_at'],
        ]);

        for ($i = 0; $i < count($validated['produk_id']); $i++) {
            $produkId = $validated['produk_id'][$i];
            $qty      = $validated['qty'][$i];
            $harga    = $validated['harga'][$i];
            $total = $qty * $harga;

            StokMasuk::create([
                'id_histori' => $histori->id,
                'id_produk'  => $produkId,
                'qty'     => $qty,
                'harga'     => $harga,
                'total' => $total,
                'created_at'    => $validated['created_at'],
            ]);

            // Update stok produk
            $produk = Produk::find($produkId);
            if ($produk) {
                $produk->stok += $qty;
                $produk->save();
            }
        }

        return redirect()->back()->with('success', 'Stok masuk berhasil disimpan!');
    }

    public function stokKeluarStore(Request $request)
    {

        $validated = $request->validate([
            'produk_id'  => 'required|array',
            'qty'        => 'required|array',
            'created_at'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $histori = StokHistori::create([
            'keterangan' => $validated['keterangan'] ?? 'TIdak ada keterangan',
            'tipe' => 'Stok Keluar',
            'created_at' => $validated['created_at'],
        ]);

        for ($i = 0; $i < count($validated['produk_id']); $i++) {
            $produkId = $validated['produk_id'][$i];
            $qty      = $validated['qty'][$i];

            StokKeluar::create([
                'id_histori' => $histori->id,
                'id_produk'  => $produkId,
                'qty'     => $qty,
                'created_at'    => $validated['created_at'],
            ]);

            // Update stok produk
            $produk = Produk::find($produkId);
            if ($produk) {
                $produk->stok -= $qty;
                $produk->save();
            }
        }

        return redirect()->back()->with('success', 'Stok keluar berhasil disimpan!');
    }

    public function stokOpnameStore(Request $request)
    {

        $validated = $request->validate([
            'produk_id' => 'required|array',
            'stok_fisik' => 'required|array',
            'created_at' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $histori = HistoriOpname::create([
            'keterangan' => $validated['keterangan'] ?? 'TIdak ada keterangan',
            'created_at' => $validated['created_at'],
        ]);

        foreach ($validated['produk_id'] as $produkId) {
            $produk = produk::find($produkId);
            $stokSistem = $produk ? $produk->stok : 0;
            $stokFisik = isset($validated['stok_fisik'][$produkId]) ? (int) $validated['stok_fisik'][$produkId] : 0;
            $selisih = $stokSistem - $stokFisik;

            StokOpname::create([
                'id_histori'   => $histori->id,
                'id_produk'    => $produkId,
                'stok_sistem'  => $stokSistem,
                'stok_fisik'   => $stokFisik,
                'selisih'      => $selisih,
                'created_at'   => $validated['created_at'],
            ]);
        }

        return redirect()->back()->with('success', 'Stok opname berhasil disimpan!');
    }
    public function detail($id)
    {
        $product = produk::findOrFail($id);
        return view('product.detail', compact('product'));
    }
    public function exportStokKeluarPDF()
    {
        $historiStokKeluar = StokHistori::with('detailStokKeluar.produk')
            ->where('tipe', 'Stok Keluar')
            ->orderBy('created_at', 'desc')
            ->get();

        // Create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Toko Aldi');
        $pdf->SetAuthor('Toko Aldi');
        $pdf->SetTitle('Laporan Stok Keluar');
        $pdf->SetSubject('Laporan Stok Keluar');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', 'B', 16);
        
        // Title
        $pdf->Cell(0, 10, 'LAPORAN STOK KELUAR', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Toko Aldi - Periode: ' . date('d F Y'), 0, 1, 'C');
        $pdf->Ln(10);

        // Table header
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(25, 135, 84);
        $pdf->SetTextColor(255);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'ID Transaksi', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Tanggal', 1, 0, 'C', true);
        $pdf->Cell(70, 10, 'Keterangan', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Total Item', 1, 1, 'C', true);

        // Table data
        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255, 255, 255);
        
        $no = 1;
        foreach ($historiStokKeluar as $histori) {
            $pdf->Cell(15, 10, $no++, 1, 0, 'C', true);
            $pdf->Cell(30, 10, '#' . $histori->id, 1, 0, 'C', true);
            $pdf->Cell(40, 10, $histori->created_at->format('d/m/Y H:i'), 1, 0, 'C', true);
            $pdf->Cell(70, 10, substr($histori->keterangan, 0, 40), 1, 0, 'L', true);
            $pdf->Cell(35, 10, $histori->detailStokKeluar->sum('qty') . ' item', 1, 1, 'C', true);
        }

        // Total
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(240, 240, 240);
        $pdf->Cell(155, 10, 'TOTAL KESELURUHAN', 1, 0, 'R', true);
        $pdf->Cell(35, 10, $historiStokKeluar->sum(function($histori) { 
            return $histori->detailStokKeluar->sum('qty'); 
        }) . ' item', 1, 1, 'C', true);

        // Footer
        $pdf->Ln(10);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(0, 10, 'Dicetak pada: ' . date('d/m/Y H:i:s'), 0, 0, 'C');

        // Output PDF
        return response($pdf->Output('stok-keluar-' . date('Y-m-d') . '.pdf', 'D'))
            ->header('Content-Type', 'application/pdf');
    }
    public function exportStokMasukPDF()
    {
        $historiStokMasuk = StokHistori::with('detailStokMasuk.produk')
            ->where('tipe', 'Stok Masuk')
            ->orderBy('created_at', 'desc')
            ->get();

        // Create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Toko Aldi');
        $pdf->SetAuthor('Toko Aldi');
        $pdf->SetTitle('Laporan Stok Masuk');
        $pdf->SetSubject('Laporan Stok Masuk');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', 'B', 16);
        
        // Title
        $pdf->Cell(0, 10, 'LAPORAN STOK MASUK', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Toko Aldi - Periode: ' . date('d F Y'), 0, 1, 'C');
        $pdf->Ln(10);

        // Table header
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(25, 135, 84);
        $pdf->SetTextColor(255);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'ID Transaksi', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'Keterangan', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'Total Item', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Total Nilai', 1, 1, 'C', true);

        // Table data
        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255, 255, 255);
        
        $no = 1;
        $totalNilai = 0;
        foreach ($historiStokMasuk as $histori) {
            $totalItem = $histori->detailStokMasuk->sum('qty');
            $totalNilaiTransaksi = $histori->detailStokMasuk->sum('total');
            $totalNilai += $totalNilaiTransaksi;
            
            $pdf->Cell(15, 10, $no++, 1, 0, 'C', true);
            $pdf->Cell(25, 10, '#' . $histori->id, 1, 0, 'C', true);
            $pdf->Cell(35, 10, $histori->created_at->format('d/m/Y'), 1, 0, 'C', true);
            $pdf->Cell(60, 10, substr($histori->keterangan, 0, 30), 1, 0, 'L', true);
            $pdf->Cell(25, 10, $totalItem . ' item', 1, 0, 'C', true);
            $pdf->Cell(30, 10, 'Rp ' . number_format($totalNilaiTransaksi, 0, ',', '.'), 1, 1, 'R', true);
        }

        // Total
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(240, 240, 240);
        $pdf->Cell(160, 10, 'TOTAL KESELURUHAN', 1, 0, 'R', true);
        $pdf->Cell(30, 10, 'Rp ' . number_format($totalNilai, 0, ',', '.'), 1, 1, 'R', true);

        // Footer
        $pdf->Ln(10);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(0, 10, 'Dicetak pada: ' . date('d/m/Y H:i:s'), 0, 0, 'C');

        // Output PDF
        return response($pdf->Output('stok-masuk-' . date('Y-m-d') . '.pdf', 'D'))
            ->header('Content-Type', 'application/pdf');
    }
    public function exportStokOpnamePDF()
    {
        $historiStokOpname = HistoriOpname::with('detailStokOpname.produk')
            ->orderBy('created_at', 'desc')
            ->get();

        // Create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Toko Aldi');
        $pdf->SetAuthor('Toko Aldi');
        $pdf->SetTitle('Laporan Stok Opname');
        $pdf->SetSubject('Laporan Stok Opname');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', 'B', 16);
        
        // Title
        $pdf->Cell(0, 10, 'LAPORAN STOK OPNAME', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Toko Aldi - Periode: ' . date('d F Y'), 0, 1, 'C');
        $pdf->Ln(10);

        // Table header
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(25, 135, 84);
        $pdf->SetTextColor(255);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'ID Opname', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Tanggal', 1, 0, 'C', true);
        $pdf->Cell(70, 10, 'Keterangan', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'Jumlah Produk', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'Selisih', 1, 1, 'C', true);

        // Table data
        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetTextColor(0);
        $pdf->SetFillColor(255, 255, 255);
        
        $no = 1;
        foreach ($historiStokOpname as $histori) {
            $jumlahProduk = $histori->detailStokOpname->count();
            $totalSelisih = $histori->detailStokOpname->sum('selisih');
            
            $pdf->Cell(15, 10, $no++, 1, 0, 'C', true);
            $pdf->Cell(25, 10, '#' . $histori->id, 1, 0, 'C', true);
            $pdf->Cell(35, 10, $histori->created_at->format('d/m/Y'), 1, 0, 'C', true);
            $pdf->Cell(70, 10, substr($histori->keterangan, 0, 40), 1, 0, 'L', true);
            $pdf->Cell(25, 10, $jumlahProduk . ' produk', 1, 0, 'C', true);
            
            // Warna selisih
            if ($totalSelisih == 0) {
                $pdf->SetTextColor(0, 128, 0); // Hijau untuk match
            } elseif ($totalSelisih > 0) {
                $pdf->SetTextColor(255, 165, 0); // Orange untuk surplus
            } else {
                $pdf->SetTextColor(255, 0, 0); // Merah untuk deficit
            }
            
            $pdf->Cell(20, 10, $totalSelisih, 1, 1, 'C', true);
            $pdf->SetTextColor(0); // Reset warna
        }

        // Footer
        $pdf->Ln(10);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(0, 10, 'Dicetak pada: ' . date('d/m/Y H:i:s'), 0, 0, 'C');

        // Output PDF
        return response($pdf->Output('stok-opname-' . date('Y-m-d') . '.pdf', 'D'))
            ->header('Content-Type', 'application/pdf');
    }
}
