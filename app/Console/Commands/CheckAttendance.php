<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CheckAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:check-attendance';
    protected $signature = 'attendance:check';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    // public function checkAttendance()
    // {
    //      // panggil fungsi handle dari CheckAttendance
    //     $checkAttendance = new \App\Console\Commands\CheckAttendance();
    //     $checkAttendance->handle();
     
    //      // ambil data kehadiran baru
    //     $newAttendances = \DB::table('kehadirans')
    //         ->whereDate('created_at', \Carbon\Carbon::today())
    //         ->orderBy('created_at', 'desc')
    //         ->get();
     
    //      // lewatkan data kehadiran baru ke view
    //     return view('attendance.check', ['newAttendances' => $newAttendances]);
    // }
     
    public function handle()
    {
        //
        $users = User::all();
        $now = Carbon::now();
        $start = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta'); // jam 08:00
        $end = Carbon::createFromTime(21, 0, 0, 'Asia/Jakarta'); // jam 17:00

        if ($now->greaterThan($end)) { // jika sekarang sudah melewati jam 17:00
            // ambil semua id_karyawan yang belum diisi absensinya hari ini
            $userIds = DB::table('users')
                ->whereNotIn('id', function ($query) {
                    $query->select('id_karyawan')
                        ->from('kehadirans')
                        ->whereDate('created_at', Carbon::today());
                })
                ->pluck('id');

            // masukkan data kehadiran dengan status alpha untuk semua id_karyawan yang belum absen
            foreach ($userIds as $userId) {
                DB::table('kehadirans')->insert([
                    'id_karyawan' => $userId,
                    'status_kehadiran' => 3, // status alpha
                    'keterangan' => '-',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

    }
        // if ($now->between($start, $end)) {
        //     foreach ($users as $user) {
        //         $attendance = DB::table('kehadirans')
        //             ->where('id_karyawan', $user->id)
        //             ->whereDate('created_at', $now->toDateString())
        //             ->first();

        //         if (!$attendance) {
        //             DB::table('kehadirans')->insert([
        //                 'id_karyawan' => $user->id,
        //                 'status_kehadiran' => 3, // 3 untuk status alpha
        //                 'keterangan' => 'tidak ada',
        //                 'created_at' => $now,
        //                 'updated_at' => $now,
        //             ]);
        //         }
        //     }

        //     $this->info('Attendance checked successfully!');
        // } else {
        //     $this->info('Tidak Bisa Absen karena di luar jam kerja 08:00 - 17:00');
        // }
    
}
