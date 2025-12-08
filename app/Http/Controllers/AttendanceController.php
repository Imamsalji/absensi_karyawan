<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now()->toDateString();

        // Riwayat absensi user login
        $attr = Attendance::where('user_id', Auth::id())->orderBy('work_date', 'desc');

        // filter jika tanggal diisi
        if ($request->start_date) {
            $attr->whereDate('work_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $attr->whereDate('work_date', '<=', $request->end_date);
        }

        $attendance = $attr->get();

        return view('attendance.index', compact('attendance', 'today'));
    }

    public function history($id)
    {
        // Riwayat absensi karyawan tertentu, untuk HRD melihat detail
        $user = User::findOrFail($id);

        $attendance = Attendance::where('user_id', $id)
            ->orderBy('work_date', 'desc')
            ->get();

        return view('attendance.history', compact('attendance', 'user'));
    }

    public function report(Request $request)
    {
        $query = Attendance::with('user')->orderBy('work_date', 'desc');

        // filter jika tanggal diisi
        if ($request->start_date) {
            $query->whereDate('work_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('work_date', '<=', $request->end_date);
        }

        if ($request->userid) {
            $query->where('user_id', $request->userid);
        }

        $report = $query->get();

        return view('attendance.report', compact('report'));
    }

    public function clockIn(Request $request)
    {
        $allowedIp = "127.0.0.1";
        $clientIp = $request->ip();

        if (!str_starts_with($clientIp, $allowedIp)) {
            return back()->with('error', "Absensi hanya dapat dilakukan dari jaringan kantor.");
        }

        $today = Carbon::now()->toDateString();

        $check = Attendance::where('user_id', Auth::id())
            ->where('work_date', $today)
            ->first();

        if ($check) {
            return back()->with('error', 'Anda sudah Clock In hari ini.');
        }

        // cek telat
        $clockInLimit = Carbon::createFromTime(7, 0, 0);
        $status = Carbon::now()->greaterThan($clockInLimit) ? 'Terlambat' : 'Tepat Waktu';

        Attendance::create([
            'user_id' => Auth::id(),
            'work_date' => $today,
            'clock_in_at' => $today . ' ' . Carbon::now()->toTimeString(),
            'ip_address' => $clientIp
        ]);

        if ($status === 'Terlambat') {
            return back()->with('error', 'Clock In berhasil, tetapi Anda TERLAMBAT!');
        }

        return back()->with('success', 'Clock In Berhasil!');
    }

    public function clockOut(Request $request)
    {
        $allowedIp = "127.0.0.1";
        $clientIp = $request->ip();

        if (!str_starts_with($clientIp, $allowedIp)) {
            return back()->with('error', "Absensi hanya dapat dilakukan dari jaringan kantor.");
        }

        $today = Carbon::now()->toDateString();
        $currentTime = Carbon::now();

        $attendance = Attendance::where('user_id', Auth::id())
            ->where('work_date', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'Silakan Clock In terlebih dahulu.');
        }

        if ($attendance->clock_out_at != null) {
            return back()->with('error', 'Anda sudah Clock Out hari ini.');
        }

        // batas clockout jam 17.00
        $clockOutLimit = Carbon::createFromTime(17, 0, 0);

        if ($currentTime->lessThan($clockOutLimit)) {
            return back()->with('error', 'Belum waktunya Clock Out. Minimal jam 17:00.');
        }

        $attendance->update([
            'clock_out_at' => $today . ' ' . Carbon::now()->toTimeString()
        ]);

        return back()->with('success', 'Clock Out Berhasil!');
    }
}
