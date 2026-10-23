<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\LaporanExport;
use App\Exports\OngkirExport;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaksi;
use App\Models\User;
use App\Models\produk;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $dataTransaksi = Transaction::all();
        $dataDetail = DetailTransaksi::all();
        $dataUser = User::all();
        $dataProduk = produk::all();

        // Data untuk ringkasan statistik
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Pendapatan bulan ini
        $pendapatanBulanIni = Transaction::where('status', 'selesai')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum(DB::raw('harga + ongkir'));

        // Total transaksi bulan ini
        $totalTransaksi = Transaction::where('status', 'selesai')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        // Produk terjual bulan ini
        $produkTerjual = DetailTransaksi::whereHas('transaksi', function($query) use ($startOfMonth, $endOfMonth) {
                $query->where('status', 'selesai')
                    ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            })
            ->sum('jumlah');

        // Data untuk grafik
        $chartData = $this->getChartData();
        
        // Ambil data detail transaksi dengan relasi transaksi dan produk
    $dataDetail = DetailTransaksi::with(['transaksi.user', 'produk'])
    ->whereHas('transaksi', function($query) {
        $query->where('status', 'selesai');
    })
    ->orderBy('created_at', 'desc')
    ->paginate(10); // 10 item per halaman

    $biaya_operasional_toko = DB::table('biaya_operasional')->where('kategori', '=','toko')->first();
    $biaya_operasional_urgent = DB::table('biaya_operasional')->where('kategori', '=','urgent')->first();

    return view('dashboard_owner.laporan', compact(
        'dataTransaksi', 
        'dataDetail',  // Kirim dataDetail yang sudah difilter
        'dataUser', 
        'dataProduk',
        'pendapatanBulanIni',
        'totalTransaksi',
        'produkTerjual',
        'chartData',
        'biaya_operasional_toko',
        'biaya_operasional_urgent'
        ));
    }

    private function getChartData()
    {
        $today = Carbon::today();
        
        // Data Harian (7 hari terakhir)
        $dailyData = [];
        $dailyLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $dailyLabels[] = $date->format('d M');
            
            $total = Transaction::where('status', 'selesai')
                ->whereDate('created_at', $date)
                ->sum(DB::raw('harga + ongkir'));
                
            $dailyData[] = $total;
        }

        // Data Mingguan (4 minggu terakhir)
        $weeklyData = [];
        $weeklyLabels = [];
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = $today->copy()->subWeeks($i)->startOfWeek();
            $endOfWeek = $today->copy()->subWeeks($i)->endOfWeek();
            
            $weeklyLabels[] = 'Minggu ' . ($i + 1);
            
            $total = Transaction::where('status', 'selesai')
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->sum(DB::raw('harga + ongkir'));
                
            $weeklyData[] = $total;
        }

        // Data Bulanan (6 bulan terakhir)
        $monthlyData = [];
        $monthlyLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = $today->copy()->subMonths($i);
            $monthlyLabels[] = $date->translatedFormat('M Y');
            
            $total = Transaction::where('status', 'selesai')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum(DB::raw('harga + ongkir'));
                
            $monthlyData[] = $total;
        }

        return [
            'daily' => [
                'labels' => $dailyLabels,
                'data' => $dailyData
            ],
            'weekly' => [
                'labels' => $weeklyLabels,
                'data' => $weeklyData
            ],
            'monthly' => [
                'labels' => $monthlyLabels,
                'data' => $monthlyData
            ]
        ];
    }

public function cari(Request $request)
{
    $tanggalMulai = $request->input('tanggal_mulai');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Validasi jika tanggal kosong
    if (!$tanggalMulai || !$tanggalAkhir) {
        return redirect()->route('laporan')->with('error', 'Harap pilih rentang tanggal.');
    }

    // Filter detail transaksi berdasarkan rentang tanggal
    $dataDetail = DetailTransaksi::with(['transaksi.user', 'produk'])
        ->whereHas('transaksi', function($query) use ($tanggalMulai, $tanggalAkhir) {
            $query->whereBetween('created_at', [$tanggalMulai, $tanggalAkhir])
                  ->where('status', 'selesai');
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // Data lain tetap sama
    $dataTransaksi = Transaction::all();
    $dataDetail = DetailTransaksi::all();
    $dataUser = User::all();
    $dataProduk = produk::all();

    return view('dashboard_owner.laporan', compact('dataTransaksi', 'dataDetail', 'dataUser', 'dataProduk'));

}

    public function excel()
    {
        return Excel::download(new LaporanExport, 'Laporan.xlsx');
    }

    public function pdf()
    {
        $dataTransaksi = Transaction::all();
        $dataDetail = DetailTransaksi::all();
        $dataUser = User::all();
        $dataProduk = produk::all();

        return view('dashboard_owner.pdfLaporan', compact('dataTransaksi', 'dataDetail', 'dataUser', 'dataProduk'));
    }

    public function chart()
    {
        // Ambil data transaksi dengan status "selesai" dan kelompokkan per bulan
        $data = Transaction::selectRaw('MONTH(created_at) as bulan, SUM(harga) as total')
            ->where('status', 'selesai')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan'); // Menggunakan keyBy agar mudah mencari bulan tertentu

        // Daftar semua bulan (Januari - Desember)
        $bulanLengkap = [];
        $pendapatanLengkap = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulanLengkap[] = Carbon::create()->month($i)->translatedFormat('F');
            $pendapatanLengkap[] = $data[$i]->total ?? 0; // Jika bulan tidak ada, set ke 0
        }

        return view('dashboard_owner.chart', compact('bulanLengkap', 'pendapatanLengkap'));
    }

    public function produkTerlaris()
    {
        $produkTerlaris = DetailTransaksi::select('produk_id')
            ->selectRaw('SUM(jumlah) as total_terjual')
            ->whereHas('transaksi', function ($query) {
                $query->where('status', 'selesai');
            })
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->take(10)
            ->get();

        $produkInfo = $produkTerlaris->map(function ($item) {
            $produk = produk::find($item->produk_id);
            return [
                'nama_produk' => $produk ? $produk->nama_produk : 'Tidak Diketahui',
                'total_terjual' => $item->total_terjual,
            ];
        });

        return view('dashboard_owner.produk-terlaris', compact('produkInfo'));
    }

    public function laporanOngkir(){
        $dataTransaksi = Transaction::all();

        return view('dashboard_owner.laporan-ongkir', compact('dataTransaksi'));
    }

    public function excelOngkir()
    {
        return Excel::download(new OngkirExport, 'laporan_ongkir.xlsx');
    }

    public function pdfOngkir()
    {
        $dataTransaksi = Transaction::all();

        return view('dashboard_owner.pdfLaporanOngkir', compact('dataTransaksi'));
    }
    
    public function update_operasioanl (Request $request)
    {
        DB::table('biaya_operasional')->where('kategori','=','toko')->update([
            'biaya' => $request->toko,
        ]);
        DB::table('biaya_operasional')->where('kategori','=','urgent')->update([
            'biaya' => $request->urgent,
        ]);

        return redirect()->back()->with('success', 'Biaya Operasioanl Berhasil di Update');
    }

    public function dashboard_owner_index()
    {
        return view('dashboard_owner.owner');
    }

}
