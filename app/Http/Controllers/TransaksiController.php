<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransaksiController extends Controller
{
    public function index()
    {
        // Pastikan relasi detail transaksi dan produk di-load
        $data = Transaction::with(['detailTransaksi.produk'])->get();
        return view('profile', ['dataTransaksi' => $data]);
    }

    public function indexAdmin()
    {
        $data = Transaction::with(['details.produk'])->get();
        return view('dashboard_admin.Transaksi.index', ['dataTransaksi' => $data]);
    }

    public function sampai($id)
    {
        $transaksi = Transaction::find($id);
        if ($transaksi && $transaksi->status === 'dikirim') {
            $transaksi->status = 'selesai';
            $transaksi->save();
            return redirect()->back()->with('success', 'Status transaksi berhasil diubah menjadi selesai!');
        }
        return redirect()->back()->with('error', 'Transaksi tidak dapat diperbarui!');
    }

    // ✅ Fungsi untuk update status setelah pembayaran
    public function updateStatus(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|integer'
        ]);

        $transaksi = Transaction::findOrFail($request->transaction_id);

        if ($transaksi->status === 'pending') {
            $transaksi->status = 'dikirim'; // Bisa diganti 'diproses' sesuai alurmu
            $transaksi->tanggal_bayar = now(); // Pastikan field ini ada di tabel
            $transaksi->save();

            return response()->json(['message' => 'Status updated to dikirim.']);
        }

        return response()->json(['message' => 'Status tidak valid.'], 400);
    }
    
}
