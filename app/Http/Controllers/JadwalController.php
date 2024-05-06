<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Menampilkan daftar jadwal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data dari tabel jadwal
        $jadwal = Jadwal::all();
        return view('jadwal', ['jadwal' => $jadwal]);
    }

    /**
     * Menampilkan formulir untuk membuat jadwal baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah_jadwal');
    }

    /**
     * Menyimpan jadwal baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh formulir
        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keterangan' => 'required',
        ]);

        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data jadwal baru ke dalam database
        Jadwal::create([
            'hari' => $request->input('hari'),
            'tanggal' => $request->input('tanggal'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'keterangan' => $request->input('keterangan'),
        ]);

        // Redirect kembali ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('jadwal')->with('success', 'Jadwal baru berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal')->with('success', 'Jadwal berhasil dihapus.');
    }
    public function edit($id)
    {
        // Mengambil data jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Mengirim data ke view dengan nama 'edit_jadwal' beserta data jadwal yang akan diedit
        return view('edit_jadwal', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan oleh formulir
        $validator = Validator::make($request->all(), [
            'hari' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'keterangan' => 'required',
        ]);

        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Perbarui data jadwal yang telah diedit ke dalam database
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'hari' => $request->input('hari'),
            'tanggal' => $request->input('tanggal'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'keterangan' => $request->input('keterangan'),
        ]);

        // Redirect kembali ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('jadwal')->with('success', 'Jadwal berhasil diperbarui.');
    }
}