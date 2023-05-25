<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class AttendanceController extends Controller
{
    //
    public function checkAttendance()
    {
        Artisan::call('attendance:check');
        return redirect()->back()->with('success', 'Attendance check has been executed successfully!');
    }
}
