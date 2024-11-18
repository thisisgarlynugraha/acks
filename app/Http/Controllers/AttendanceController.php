<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AttendanceController extends Controller
{
    public function index()
    {
        $title = "Attendance - Data";

        return view('master.attendance.index', compact('title'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        try {
            $title = "Health Monitoring - Detailed Data";

            $studentId = Crypt::decrypt($id);
            $data = Student::find($studentId);

            return view('master.attendance.show', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('attendance.index');
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function data()
    {
        $data = Student::latest()->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('gender', function ($item) {
                            return $item->gender ? 'Male' : 'Female';
                        })
                        ->addColumn('action', 'master.attendance.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }

    public function dataShow(string $id)
    {
        try {
            $studentId = Crypt::decrypt($id);
            $data = Attendance::latest()->where('student_id', $studentId)->get();

            return DataTables::of($data)
                            ->addIndexColumn()->addColumn('date', function($item) {
                                return Carbon::parse($item->datetime)->format('M d, Y');
                            })
                            ->addColumn('time', function($item) {
                                return Carbon::parse($item->datetime)->format('H:i') . ' WIB';
                            })
                            ->addColumn('status', function($item) {
                                return 'Hadir';
                            })
                            ->rawColumns(['date', 'time', 'status'])
                            ->make(true);
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('attendance.index');
        }
    }
}
