<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HealthMonitoringResource;
use App\Models\HealthMonitoring;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HealthMonitoringController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        try {
            $Validator = Validator::make($request->all(), [
                'nik' => 'required',
                'weight'   => 'required',
                'height'   => 'required',
                'temperature'   => 'required',
                'spo2'   => 'required',
                'heart_rate'   => 'required',
                'stress_level'   => 'required',
                'imt'   => 'required',
            ]);
    

            if ($Validator->fails()) {
                return response()->json($Validator->errors(), 422);
            }

            $Student = Student::where('nik', $request->nik)->get()->first();

            if ($Student != NULL) {
                $HealthMonitoring = HealthMonitoring::create([
                    'student_id' => $Student->id,
                    'weight' => $request->weight,
                    'height' => $request->height,
                    'temperature' => $request->temperature,
                    'spo2' => $request->spo2,
                    'heart_rate' => $request->heart_rate,
                    'stress_level' => $request->stress_level,
                    'imt' => $request->imt,
                ]);
            }

            return new HealthMonitoringResource(true, 'You\'ve Successfully Registered', $HealthMonitoring);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function store(Request $request)
    {
        //
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
