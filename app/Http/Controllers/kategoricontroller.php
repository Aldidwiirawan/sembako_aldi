<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori; // PASTIKAN NAMA MODEL 'Kategori' (huruf K besar)

// PASTIKAN NAMA CLASS 'KategoriController' (PascalCase)
class KategoriController extends Controller 
{
    /**
     * Menampilkan daftar kategori beserta jumlah produk.
     */
    public function index()
    {
        // 1. Tambahkan withCount('produk')
        // 2. Ganti nama model menjadi 'Kategori' (standar PSR-4)
        $data = Kategori::withCount('produk')->paginate(10); 
        
        return view('dashboard_admin.Kategori.index', ['datakategori' => $data]);
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('dashboard_admin.Kategori.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // 2. Tambahkan Validasi (SANGAT PENTING)
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
            // Jika Anda punya 'id' sebagai KODE (bukan primary key), validasi di sini
            // 'kode_kategori' => 'required|string|unique:kategoris,kode_kategori'
        ]);

        $data = new Kategori();
        
        // 3. Hapus baris ini. Biarkan database yang mengatur ID (auto-increment).
        // $data->id = $request->id; 
        
        $data->nama_kategori = $request->nama_kategori;
        $data->save();

        // 4. Gunakan nama route dan tambahkan pesan sukses
        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit($id)
    {
        $data = Kategori::findOrFail($id); // Gunakan findOrFail agar error jika data tidak ada
        return view('dashboard_admin.Kategori.edit', compact('data'));
    }

    /**
     * Update data kategori di database.
     */
    public function update(Request $request, $id)
    {
        $data = Kategori::findOrFail($id);

        // 2. Tambahkan Validasi untuk update
        $request->validate([
            // Rule unique: diabaikan jika namanya sama dengan nama data yg sedang diedit
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $data->id,
        ]);

        $data->nama_kategori = $request->nama_kategori;
        
        // 5. Gunakan save() karena Anda sudah mengisi properti
        $data->save(); 

        // 4. Gunakan nama route dan tambahkan pesan sukses
        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus data kategori dari database.
     */
    public function destroy($id)
    {
        $data = Kategori::findOrFail($id);
        
        // Tambahan: Cek jika kategori masih punya produk (opsional tapi disarankan)
        if ($data->produk()->count() > 0) {
            return redirect()->route('kategori.index')
                             ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }

        $data->delete();

        // 4. Gunakan nama route dan tambahkan pesan sukses
        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}