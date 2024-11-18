<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $Validator = Validator::make($request->all(), [
                'nik' => 'required',
            ]);
    

            if ($Validator->fails()) {
                return response()->json($Validator->errors(), 422);
            }

            $Student = Student::where('nik', $request->nik)->get()->first();

            if ($Student != NULL) {
                $Attendance = Attendance::create([
                    'student_id' => $Student->id,
                    'date' => Carbon::now(),
                ]);
            }

            return new AttendanceResource(true, 'You\'ve Successfully Registered', $Attendance);
        } catch (Exception $excep) {
            return new AttendanceResource(false, 'Error', $excep);
        }
    }

    public function show(string $id)
    {
        //
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
}
