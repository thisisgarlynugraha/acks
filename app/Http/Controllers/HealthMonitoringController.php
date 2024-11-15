<?php

namespace App\Http\Controllers;

use App\Models\HealthMonitoring;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class HealthMonitoringController extends Controller
{
    public function index()
    {
        $title = "Health Monitoring - Data";

        return view('master.health-monitoring.index', compact('title'));
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

            return view('master.health-monitoring.show', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('health-monitoring.index');
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
                        ->addColumn('action', 'master.health-monitoring.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }

    public function dataShow(string $id)
    {
        try {
            $studentId = Crypt::decrypt($id);
            $data = HealthMonitoring::latest()->where('student_id', $studentId)->get();

            return DataTables::of($data)
                            ->addIndexColumn()->addColumn('date', function($item) {
                                return Carbon::parse($item->datetime)->format('M d, Y');
                            })
                            ->rawColumns(['date'])
                            ->make(true);
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('health-monitoring.index');
        }
    }
}
