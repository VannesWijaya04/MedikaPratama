<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pegawais = DB::select("SELECT pegawais.*, jabatans.jabatan from pegawais JOIN jabatans on jabatans.id= jabatan_id");
        //$pegawais = DB::select("SELECT pegawais.*, genders.jenis_kelamin from pegawais JOIN genders on genders.id= jenis_kelamin");  
        return view("pegawais.index")->with('pegawais', $pegawais);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = DB::select("SELECT * FROM jabatans");
        return view("pegawais.create")->with('jabatans', $jabatans);

        // $genders = DB::select("SELECT * FROM genders");
        // return view("pegawais.create")->with('genders', $genders);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vallidate = $request->validate([
            'pegawais' => 'required',
            'gender' => 'required',
            'jabatan' => 'required',

        ]);

        $pegawais = new Pegawai();
        $pegawais->nama_karyawan = $vallidate['pegawais'];
        $pegawais->jenis_kelamin = $vallidate['gender'];
        $pegawais->jabatan_id = $vallidate['jabatan'];
        $pegawais->save();
        return redirect()->route('pegawais.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $jabatans = Jabatan::all();
        return view('pegawais.edit')
            ->with('pegawai', $pegawai)
            ->with('jabatan', $jabatans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //
        $vallidate = $request->validate([
            'pegawais' => 'required',
            'gender' => 'required',
            'jabatan' => 'required',

        ]);

        $pegawai->update([
            'pegawais' => $request->nama_karyawan,
            'gender' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan_id
        ]);

        //Pegawai::where('id', $pegawai->id)->update($vallidate);
        $request->session()->flash('pesan', 'Perubahan data berhasil');
        return redirect()->route('pegawais.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        //
        $pegawai->delete();
        return redirect()->back();
    }
}
