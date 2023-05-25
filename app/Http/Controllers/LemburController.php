<?php

namespace App\Http\Controllers;

use App\Models\lembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\KaryawanController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        //
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        $user_id = Auth::id();
        // $lemburs = DB::select("SELECT * from lemburs");
        $lemburs = DB::table('lemburs')
        ->join('users', 'lemburs.id_karyawan', '=', 'users.id')
            ->whereMonth('lemburs.created_at', $bulan)
            ->whereYear('lemburs.created_at', $tahun)
            ->where('users.id', $user_id)
            ->select('lemburs.lembur', 'lemburs.created_at')
            ->get();
        return view('lemburs.index')->with('lemburs', $lemburs);
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
        $start = Carbon::createFromTime(19, 00, 0, 'Asia/Jakarta'); // jam 08:00
        $end = Carbon::createFromTime(24, 0, 0, 'Asia/Jakarta'); // jam 17:00
    
        if ($now->between($start, $end)) {
            $user_id = Auth::user()->id;
            $today = Carbon::today();
            //$time = Carbon::time();
            $absen_masuk = DB::table('lemburs')
                ->where('id_karyawan', $user_id)
                ->whereDate('created_at', $today)
                ->first();
        
            $absen_keluar = DB::table('lemburs')
                ->where('id_karyawan', $user_id)
                ->whereDate('created_at', $today)
                ->first();

            if ($absen_masuk || $absen_keluar) {
                return redirect()->route('lemburs.index')->with('error', 'Anda sudah membuat absen lembur hari ini');
            }
              
            return view("lemburs.create");
    
    
        } else {
                echo "Tidak Bisa Absen karena di luar jam kerja lembur 22:00 - 00:00";
    
                //return redirect()->route('kehadirans.index')->with('error', 'Tidak Bisa Absen karena di luar jam kerja 08:00 - 17:00');
    
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $vallidate = $request->validate([
            'lembur' => 'required',
            'id_karyawan' => 'required',
        ]);

        $lemburs = new Lembur();
        $lemburs->id_karyawan = $vallidate['id_karyawan'];
        $lemburs->lembur = $vallidate['lembur'];
        $lemburs->save();

        return redirect()->route('lemburs.index')->with('success', 'Absen berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(lembur $lembur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lembur $lembur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lembur $lembur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lembur $lembur)
    {
        //
    }
}
