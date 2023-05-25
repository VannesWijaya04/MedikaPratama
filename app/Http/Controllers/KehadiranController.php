<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\KaryawanController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pegawais = DB::select("SELECT pegawais.*, jabatans.jabatan from pegawais JOIN jabatans on jabatans.id= jabatan_id");
        // $kehadirans = DB::select("SELECT kehadirans.*, status_kehadirans.status_kehadiran, users.level
        // from kehadirans 
        // JOIN status_kehadirans ON status_kehadirans.id = kehadirans.status_kehadiran 
        // JOIN users on users.id = kehadirans.id_karyawan ")
        // ->whereMonth('created_at', $bulan)
        // ->whereYear('created_at', $tahun)
        // ->get();;

        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        $user_id = Auth::id();
        $kehadirans = DB::table('kehadirans')
            ->join('status_kehadirans', 'status_kehadirans.id', '=', 'kehadirans.status_kehadiran')
            ->join('users', 'users.id', '=', 'kehadirans.id_karyawan')
            ->whereMonth('kehadirans.created_at', $bulan)
            ->whereYear('kehadirans.created_at', $tahun)
            ->where('users.id', $user_id)
            ->get(['kehadirans.*', 'status_kehadirans.status_kehadiran', 'users.level']);

        
        // check attendance today
        $kehadiran_hari_inis = DB::select("SELECT kehadirans.id, kehadirans.id_karyawan, users.name, status_kehadirans.status_kehadiran, kehadirans.keterangan, DATE(kehadirans.created_at) AS 'tanggal'
        FROM `kehadirans`
        JOIN users ON users.id = kehadirans.id_karyawan
        JOIN status_kehadirans ON status_kehadirans.id = kehadirans.status_kehadiran
        WHERE DATE(kehadirans.created_at) = DATE(NOW()) AND kehadirans.status_kehadiran = '3'")
        ;

        return view('kehadirans.index')
            ->with('kehadirans', $kehadirans)
            ->with('bulan', $bulan)
            ->with('tahun', $tahun)
            ->with('kehadiran_hari_inis', $kehadiran_hari_inis);
    }
        

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('viewAny', User::class);
        $now = Carbon::now();
        //dd($now);
        $start = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta'); // jam 08:00
        $end = Carbon::createFromTime(21, 0, 0, 'Asia/Jakarta'); // jam 17:00
    
        if ($now->between($start, $end)) {
            $user_id = Auth::user()->id;
            $today = Carbon::today();
            //$time = Carbon::time();
            $absen_masuk = DB::table('kehadirans')
                ->where('id_karyawan', $user_id)
                ->whereDate('created_at', $today)
                ->first();
        
            $absen_keluar = DB::table('kehadirans')
                ->where('id_karyawan', $user_id)
                ->whereDate('created_at', $today)
                ->first();
        
            if ($absen_masuk || $absen_keluar) {
                return redirect()->route('kehadirans.index')->with('error', 'Anda sudah membuat absen hari ini');
            }
          
            $status_kehadirans = DB::select("SELECT * FROM status_kehadirans");
            return view("kehadirans.create")->with('status_kehadirans', $status_kehadirans);


        } else {
            echo "Tidak Bisa Absen karena di luar jam kerja 07:00 - 21:00";

            //return redirect()->route('kehadirans.index')->with('error', 'Tidak Bisa Absen karena di luar jam kerja 08:00 - 17:00');

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
 
        $vallidate = $request->validate([
            'status_kehadiran' => 'required',
            'keterangan' => 'required',
            'id_karyawan' => 'required',
            //'jam'=> 'required',
            //'keterangan' => $request->input('status_kehadiran') === 'izin' ? 'required' : ''
        ]);

        //$id_karyawan = Auth::()->id;

        

        $kehadirans = new Kehadiran();
        $kehadirans->id_karyawan = $vallidate['id_karyawan'];
        $kehadirans->status_kehadiran = $vallidate['status_kehadiran'];
        $kehadirans->keterangan = $vallidate['keterangan'];
        //$kehadirans->jam = $vallidate['jam'];
        $kehadirans->save();
        // Kehadiran::create([
        //     'status_kehadiran' => $request->input('status_kehadiran'),
        //     'keterangan' => $request->input('keterangan')
        // ]);

        return redirect()->route('kehadirans.index')->with('success', 'Absen berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kehadiran $kehadiran)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kehadiran $kehadiran)
    {
        //
    }
}
