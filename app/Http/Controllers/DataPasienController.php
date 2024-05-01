<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Validation\Rule;

class DataPasienController extends Controller
{
    public function index(Request $request){
        $query = $request->input('search');
        if ($query) {
            $pasiens = Pasien::where('nama', 'like', '%' . $query . '%')
                ->orWhere('alamat', 'like', '%' . $query . '%')
                ->orWhere('no_telepon', 'like', '%' . $query . '%')
                ->paginate(10);
        } else {
            $pasiens = Pasien::paginate(10);
        }
        // $pasiens = DB::table('pasiens')->paginate(5);
        // $pasiens = Pasien::all();
        return view('data_pasien.index', compact('pasiens'));
    }

    public function add(){
        return view('data_pasien.add');
    }

    public function edit($id){

        $pasien = Pasien::findOrFail($id);
        return view('data_pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string|max:255',
            'no_registrasi' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|min:12|max:13', 
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
        ]);

        
        $pasien = Pasien::findOrFail($id);

        
        $pasien->tanggal = $request->tanggal;
        $pasien->nama = $request->nama;
        $pasien->no_registrasi = $request->no_registrasi;
        $pasien->alamat = $request->alamat;
        $pasien->no_telepon = $request->no_telepon;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->save();

        
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui');
    }

    public function simpan(Request $request)
    {
        
        try {
            $request->validate([
                'tanggal' => 'required|date',
                'nama' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('pasiens')->ignore($request->id),
                ],
                'no_registrasi' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('pasiens')->ignore($request->id),
                ],
                'alamat' => 'required|string',
                'no_telepon' => 'required|string|min:12|max:13', 
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
            ]);
        } catch (ValidationException $e) {
            if ($e->errors()['nama']) {
                return redirect()->back()->withInput()->with('error', 'Nama sudah terdaftar.');
            } elseif ($e->errors()['no_registrasi']) {
                return redirect()->back()->withInput()->with('error', 'Nomor registrasi sudah digunakan.');
            }
            throw $e;
        }
    
        $pasien = new Pasien();
        $pasien->tanggal = $request->tanggal;
        $pasien->nama = $request->nama;
        $pasien->no_registrasi = $request->no_registrasi;
        $pasien->alamat = $request->alamat;
        $pasien->no_telepon = $request->no_telepon;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->save();
    
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil disimpan');
    
    }

    public function delete($id)
    {
        
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus');
    }

    public function searchPasien(Request $request)
{
    $term = $request->input('term');
    $pasien = Pasien::where('nama', 'LIKE', '%' . $term . '%')->get(['nama']);
    return response()->json($pasien);
}
}
