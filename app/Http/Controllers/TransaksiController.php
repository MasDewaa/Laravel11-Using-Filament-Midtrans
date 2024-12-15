<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Katalog;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'katalog_id' => 'required|exists:katalog,id',
            'user_id' => 'required|exists:users,id',
            'additional' => 'nullable|string|max:255',
        ]);

        $katalog = Katalog::findOrFail($validated['katalog_id']);

        $transaksi = Transaksi::create([
            'katalog_id' => $validated['katalog_id'],
            'user_id' => $validated['user_id'],
            'total_harga' => $katalog->harga,
            'additional' => $validated['additional'],
            'status' => 'belum bayar', // Default status
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
    }

    public function index()
    {
        $transaksis = Transaksi::with(['katalog', 'user'])->get();
        return view('transaksi', compact('transaksis'));
    }
}
