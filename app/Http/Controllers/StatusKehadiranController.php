<?php

namespace App\Http\Controllers;

use App\Models\StatusKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusKehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('adminOnly', User::class);
        //
        //$users = DB::select("SELECT name AS 'nama_karyawan', jabatans.jabatan,email ,jenis_kelamin FROM users JOIN jabatans on jabatans.id= users.jabatan WHERE email != 'vanes@gmail.com'");
        $status = DB::select("SELECT * from status_kehadirans");
        return view("statusKehadirans.index")->with('status', $status);;
        // ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('adminOnly', User::class);
        return view("statusKehadirans.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $vallidate = $request->validate([
            'statushadir' => 'required',

        ]);

        $status = new StatusKehadiran();
        $status->status_kehadiran = $vallidate['statushadir'];
        $status->save();
        return redirect()->route('statusKehadirans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusKehadiran $statusKehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusKehadiran $statusKehadiran)
    {
        //
        
        
        $this->authorize('adminOnly', User::class);
        return view('statusKehadirans.edit')->with('statusKehadiran', $statusKehadiran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusKehadiran $statusKehadiran)
    {
        //
        $vallidate = $request->validate([
            'status_kehadiran' => 'required',
        ]);

        $statusKehadiran->update([
            'status_kehadiran' => $request->status_kehadiran
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        //User::where('name', $karyawan->name)->update($vallidate);
        return redirect()->route('statusKehadirans.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_status_kehadiran)
    {
        //
        //$statusKehadiran->delete();
        // echo $id_status_kehadiran;

        DB::delete("DELETE FROM status_kehadirans WHERE status_kehadirans.id = $id_status_kehadiran"); // Querry

        // $statusKehadiran = StatusKehadiran::where('id', $id_status_kehadiran); // Eloquent
        // $statusKehadiran->delete(); // Eloquent
        return redirect()->back();
    }
}
