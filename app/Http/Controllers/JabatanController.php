<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $this->authorize('adminOnly', User::class);
        $jabatans = DB::select("SELECT * from jabatans");
        
        return view("jabatans.index")->with('jabatans', $jabatans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('adminOnly', User::class);
        return view("jabatans.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $vallidate = $request->validate([
            'jabatans' => 'required'

        ]);

        $jabatans = new Jabatan();
        $jabatans->jabatan = $vallidate['jabatans'];
        $jabatans->save();
        return redirect()->route('jabatans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        //
        $this->authorize('adminOnly', User::class);
        return view('jabatans.edit')->with('jabatan', $jabatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        //
        $vallidate = $request->validate([
            'jabatan' => 'required'

        ]);

        Jabatan::where('id', $jabatan->id)->update($vallidate);
        return redirect()->route('jabatans.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        //
        $jabatan->delete();
        return redirect()->back();
    }
}
