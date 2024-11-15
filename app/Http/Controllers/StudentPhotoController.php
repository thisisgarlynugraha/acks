<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentHasPhoto;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class StudentPhotoController extends Controller
{
    public function index(string $id)
    {
        try {
            $title = "Student Photo - Data";

            $studentId = Crypt::decrypt($id);
            $data = Student::find($studentId);

            $confTitle = 'Delete Subject Data!';
            $confText = "Are you sure you want to delete?";

            confirmDelete($confTitle, $confText);

            return view('master.student.photo.index', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        }
    }

    public function create(string $id)
    {
        try {
            $title = "Student Photo - Create";

            $studentId = Crypt::decrypt($id);
            $data = Student::find($studentId);

            return view('master.student.photo.create', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        }
    }

    public function store(Request $request, string $id)
    {
        try {
            $studentId = Crypt::decrypt($id);
            $student = Student::findOrFail($studentId);

            if($request->hasFile('files')) {
                $files = $request->file('files');
                
                foreach ($files as $file) {
                    $path = $file->store('public/photo/' . $student->nisn);

                    StudentHasPhoto::create([
                        'student_id' => $student->id,
                        'url' => $path
                    ]);
                }
            }
    
            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('student.photo.index', Crypt::encrypt($student->id));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        } catch (\Exception $excep) {
            Log::error('Error Updating Student: ' . $excep->getMessage());
        
            Alert::error('Error', 'An error occurred while updating the student.');
            return redirect()->back()->withInput();
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
        try {
            $studentPhotoId = Crypt::decrypt($id);
            $studentPhoto = StudentHasPhoto::findOrFail($studentPhotoId);

            $studentPhoto->delete();

            Alert::success('Congrats', 'You\'ve Successfully Deleted');
            return redirect()->route('student.photo.index', Crypt::encrypt($studentPhoto->student_id));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        }
    }

    public function data(string $id)
    {
        try {
            $studentId = Crypt::decrypt($id);
            $data = StudentHasPhoto::latest()->where('student_id', $studentId)->get();

            return DataTables::of($data)->addColumn('action', 'master.student.photo.action')
                                        ->addColumn('url', function($item) {
                                            return '<img style="max-width: 150px;" src="' . Storage::url($item->url) . '"/>';
                                        })
                                        ->editColumn('is_featured', function($item) {
                                            return $item->is_featured ? 'Yes' : 'No';
                                        })
                                        ->rawColumns(['url', 'action'])
                                        ->make(true);
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        }
    }
}
