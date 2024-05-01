<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pasien;
use App\Models\Transaksi;
use App\Exports\TransaksiExport;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;


class TransaksiController extends Controller
{
    public function index(Request $request){
        $query = $request->input('search');
        if ($query) {
            $transaksi = Transaksi::where('nama', 'like', '%' . $query . '%')
                ->orWhere('alamat', 'like', '%' . $query . '%')
                ->orWhere('no_telepon', 'like', '%' . $query . '%')
                ->paginate(10);
        } else {
            $transaksi = Transaksi::paginate(10);
        }
        return view('transaksi.index', compact('transaksi'));
    }

    public function add(Request $request){
        return view ('transaksi.add');
    }

    public function getPasiens(){
        $pasiens = Pasien::all('id', 'nama');
        return $pasiens;
    }

    public function getPasienDetails($id)
    {
        $pasienss = Pasien::findOrFail($id);
        return response()->json([
            'id' => $pasienss->id, // Tambahkan id pasien ke dalam respons JSON
            'nama' => $pasienss->nama,
            'no_registrasi' => $pasienss->no_registrasi,
            'alamat' => $pasienss->alamat,
            'no_telepon' => $pasienss->no_telepon,
            'jenis_kelamin' => $pasienss->jenis_kelamin,
            // Tambahkan atribut lain sesuai kebutuhan
    ]);
    }

    public function getPasienBySearch(Request $request)
{
    $query = $request->query('query');

    // Cari pasien berdasarkan nama atau nomor registrasi
    $pasien = Pasien::where('nama', 'like', '%' . $query . '%')
        ->orWhere('no_registrasi', 'like', '%' . $query . '%')
        ->first();

    // Kembalikan informasi pasien sebagai respons JSON
    return response()->json($pasien);
}


    public function simpan(Request $request)
    {
        // $request->validate([
        //     'tanggal' => 'required|date',
        //     'nama' => 'required|string|max:255',
        //     'no_registrasi' => 'required|string|max:50',
        //     'alamat' => 'required|string',
        //     'no_telepon' => 'required|string|min:12|max:13',
        //     'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        //     'jasa_tindakan' => 'required|string|max:255',
        //     'harga_obatobatan' => 'required|numeric',
        //     'jasa_pemeriksaan_lain' => 'required|numeric',
        //     'laba_bersih' => 'required|numeric',
        // ]);

        $pasien = Pasien::findOrFail($request->pasien_id);

        Transaksi::create([
            'tgl' => $request->tanggal,
            'nama' => $pasien->nama, // Mengambil nama dari pasien yang dipilih
            'no_registrasi' => $request->no_registrasi,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jasa_tindakan' => $request->jasa_tindakan,
            'harga_obatobatan' => $request->harga_obatobatan,
            'jasa_pemeriksaan_lain' => $request->jasa_pemeriksaan_lain,
            'total' => $request->harga_obatobatan + $request->jasa_pemeriksaan_lain + $request->jasa_tindakan,
            'laba_bersih' => $request->jasa_tindakan + $request->jasa_pemeriksaan_lain,
            'pasien_id' => $request->pasien_id,
        ]);
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function exportToExcel()
    {
        return Excel::download(new TransaksiExport, 'transaksi.xlsx');
    }

    public function exportToPDF()
    {
        $transaksis = Transaksi::all();

        $pdf = PDF::loadView('exports.transaksi_pdf', compact('transaksis'));

        return $pdf->download('transaksi.pdf');
    }

}
