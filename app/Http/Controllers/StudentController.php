<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        $title = "Student - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.student.index', compact('title'));
    }

    public function create()
    {
        $title = "Student - Create";

        return view('master.student.create', compact('title'));
    }

    public function store(Request $request)
    {
        try {
            $gender = $request->gender == 'male' ? true : false;

            Student::create([
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'gender' => $gender,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])->assignRole('student');

            Alert::success('Congrats', 'You\'ve Successfully Created');
            return redirect()->route('student.index');
        } catch (\Exception $excep) {
            Log::error('Error Adding Student: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while adding the student.');
            return redirect()->back()->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        try {
            $title = "Student - Edit";

            $userId = Crypt::decrypt($id);
            $data = Student::find($userId);

            return view('master.student.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $studentId = Crypt::decrypt($id);
            $student = Student::findOrFail($studentId);

            $gender = $request->gender == 'male' ? true : false;

            $student->update([
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'name' => $request->name,
                'gender' => $gender,
                'email' => $request->email,
            ]);
    
            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('student.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        } catch (\Exception $excep) {
            Log::error('Error Updating Student: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while updating the student.');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $studentId = Crypt::decrypt($id);
            Student::findOrFail($studentId)->delete();

            Alert::success('Congrats', 'You\'ve Successfully Deleted');
            return redirect()->route('student.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        }
    }

    public function data()
    {
        $data = Student::latest()->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('gender', function ($item) {
                            return $item->gender ? 'Male' : 'Female';
                        })
                        ->addColumn('action', 'master.student.action')
                        ->rawColumns(['action'])
                        ->make(true);
    }
}
