<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    // Display students without login accounts
    public function students()
    {
        $students = Student::whereNull('user_id')
            ->orderBy('name')
            ->get();

        return view('admin.accounts.students', compact('students'));
    }

    // Create login account for an existing student
    public function storeStudent(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($data) {

            $student = Student::whereNull('user_id')
                ->lockForUpdate()
                ->findOrFail($data['student_id']);

            $user = User::create([
                'name' => $student->name,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'student',
            ]);

            $student->user()->associate($user);
            $student->save();
        });

        return redirect()
            ->route('admin.accounts.students')
            ->with('success', 'Student login account created successfully.');
    }

    // Display teachers without login accounts
    public function teachers()
    {
        $teachers = Teacher::whereNull('user_id')
            ->orderBy('name')
            ->get();

        return view('admin.accounts.teachers', compact('teachers'));
    }

    // Create login account for an existing teacher
    public function storeTeacher(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($data) {

            $teacher = Teacher::whereNull('user_id')
                ->lockForUpdate()
                ->findOrFail($data['teacher_id']);

            $user = User::create([
                'name' => $teacher->name,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'teacher',
            ]);

            $teacher->user()->associate($user);
            $teacher->save();
        });

        return redirect()
            ->route('admin.accounts.teachers')
            ->with('success', 'Teacher login account created successfully.');
    }
}
