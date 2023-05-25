<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('adminOnly', User::class);
        //
        // $karyawans = DB::select("SELECT * FROM karyawans");
        //$karyawans = DB::select("SELECT id, name AS 'nama_karyawan' FROM users");
        $users = DB::select("SELECT users.id, name AS 'nama_karyawan', jabatans.jabatan,status_karyawan,email ,jenis_kelamin , level
        FROM users 
        JOIN jabatans on jabatans.id = users.jabatan");
        return view("karyawans.index")->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('adminOnly', User::class);
        //
        $jabatans = DB::select("SELECT * FROM jabatans");
        return view('karyawans.create')->with('jabatans', $jabatans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'jenis_kelamin' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $levelIs = 'A';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);
        $user->save();


        event(new Registered($user));

        return redirect()->route('karyawans.index')->with('success', 'Karyawan berhasil dibuat');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('adminOnly', User::class);
        //
        $karyawan = DB::select("SELECT users.id, users.name, jabatans.jabatan FROM users 
        JOIN jabatans ON jabatans.id = users.jabatan
        WHERE users.id = $id
        LIMIT 1");

        if (isset($_GET["filter_tanggal"])) {
            $fullDate = $_GET['filter_tanggal'];

            $date=strtotime($fullDate);
            $month=date("m",$date);
            $year=date("Y",$date);

            $kehadirans = DB::select("SELECT kehadirans.id, users.name, status_kehadirans.status_kehadiran, kehadirans.keterangan, DATE(kehadirans.created_at) AS 'tanggal'
            FROM `kehadirans`
            JOIN users ON users.id = kehadirans.id_karyawan
            JOIN status_kehadirans ON status_kehadirans.id = kehadirans.status_kehadiran
            WHERE kehadirans.id_karyawan = $id AND MONTH(kehadirans.created_at) = $month AND YEAR(kehadirans.created_at) = $year");

            $lemburs = DB::select("SELECT lemburs.id, lemburs.lembur, DATE(lemburs.created_at) AS 'tanggal'
            FROM `lemburs`
            WHERE lemburs.id_karyawan = $id AND MONTH(lemburs.created_at) = $month AND YEAR(lemburs.created_at) = $year");


            return view("karyawans.show")
                ->with('kehadirans', $kehadirans)
                ->with('karyawan', $karyawan[0])
                ->with('lemburs', $lemburs);

        } else {
            return view("karyawans.show")->with('karyawan', $karyawan[0]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $karyawan)
    {
        $this->authorize('adminOnly', User::class);
        $jabatans = DB::select("SELECT * FROM jabatans");
        return view('karyawans.edit')->with('karyawan', $karyawan)->with('jabatans', $jabatans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $karyawan)
    {
        //
        $vallidate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'status_karyawan' => 'required',
            'level' => 'required',
            'password' => 'required',


        ]);

        $karyawan->update([
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'status_karyawan' => $request->status_karyawan,
            'level' => $request->level,
            'password' => $request->password
        ]);

        $request->session()->flash('pesan', 'Perubahan data berhasil');
        //User::where('name', $karyawan->name)->update($vallidate);
        return redirect()->route('karyawans.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $karyawan)
    {
        //
        $karyawan->delete();
        // DB::delete("DELETE FROM users WHERE users.id = $karyawan->id");
        return redirect()->back();
    }
}
