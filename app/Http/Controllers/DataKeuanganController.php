<?php

namespace App\Http\Controllers;

use App\Models\DataKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKeuanganController extends Controller
{
    /**
     * Menampilkan semua data keuangan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data dari tabel data_keuangan
        $datakeuangan = DataKeuangan::all();
        return view('keuangan', ['datakeuangan' => $datakeuangan]);
    }

    /**
     * Menampilkan form untuk menambahkan data keuangan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah_keuangan');
    }

    /**
     * Menyimpan data keuangan yang baru ditambahkan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan oleh formulir
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric',
        ]);

        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data keuangan baru ke dalam database
        $datakeuangan = DataKeuangan::create($request->all());

        // Mengupdate saldo_akhir
        $this->updateSaldoAkhir($datakeuangan);

        // Redirect kembali ke halaman daftar data keuangan dengan pesan sukses
        return redirect()->route('keuangan')->with('success', 'Data keuangan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data keuangan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mengambil data keuangan berdasarkan ID
        $datakeuangan = DataKeuangan::findOrFail($id);

        // Mengirim data ke view edit_data_keuangan beserta data keuangan yang akan diedit
        return view('edit_keuangan', compact('datakeuangan'));
    }

    /**
     * Menyimpan perubahan data keuangan yang diedit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan oleh formulir
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'kategori' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric',
        ]);

        // Jika validasi gagal, kembalikan dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Perbarui data keuangan yang telah diedit ke dalam database
        $datakeuangan = DataKeuangan::findOrFail($id);
        $datakeuangan->update($request->all());

        // Mengupdate saldo_akhir
        $this->updateSaldoAkhir($datakeuangan);

        // Redirect kembali ke halaman daftar data keuangan dengan pesan sukses
        return redirect()->route('keuangan')->with('success', 'Data keuangan berhasil diperbarui.');
    }

    /**
     * Menghapus data keuangan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menghapus data keuangan berdasarkan ID
        $datakeuangan = DataKeuangan::findOrFail($id);
        $datakeuangan->delete();

        // Redirect kembali ke halaman daftar data keuangan dengan pesan sukses
        return redirect()->route('data_keuangan')->with('success', 'Data keuangan berhasil dihapus.');
    }

    /**
     * Menghitung dan memperbarui saldo_akhir.
     *
     * @param  \App\Models\DataKeuangan  $datakeuangan
     * @return void
     */
    private function updateSaldoAkhir(DataKeuangan $datakeuangan)
    {
        $totalPemasukan = DataKeuangan::where('kategori', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = DataKeuangan::where('kategori', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;
        $datakeuangan->saldo_akhir = $saldoAkhir;
        $datakeuangan->save();
    }
}
