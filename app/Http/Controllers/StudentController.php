<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    // 1. Display all students
    public function index()
    {
        $students = Student::with('courseDetails.teacher')
            ->latest()
            ->get();
        return view('students.index', compact('students'));
    }

    // 2. Display registration form
    public function create()
    {
        $courses = Course::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('students.create', compact('courses'));
    }

    // 3. Store a new student
    public function store(Request $request)
    {
        $data = $request->validate([

            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|digits:10',
            'date_of_birth' => 'nullable|date|before:today',
            'course_id' => 'required|exists:courses,id',
            'marks' => 'required|integer|between:0,100',

        ]);

        $course = Course::findOrFail($data['course_id']);

        // Keep the old course name column synchronized
        $data['course'] = $course->name;

        Student::create($data);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student registered successfully!');
    }


    // 4. Display individual student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // 5. Display edit form
    public function edit(Student $student)
{
    $courses = Course::where('is_active', true)
        ->orderBy('name')
        ->get();

    return view('students.edit', compact('student', 'courses'));
}


    // 6. Update existing student
    public function update(Request $request, Student $student)
{
    $data = $request->validate([

        'name' => 'required|string|min:3|max:255',

        'email' => [
            'required',
            'email',
            Rule::unique('students', 'email')->ignore($student->id),
        ],

        'phone' => 'required|digits:10',

        'date_of_birth' => 'nullable|date|before:today',

        'course_id' => 'required|exists:courses,id',

        'marks' => 'required|integer|between:0,100',

    ]);

    $course = Course::findOrFail($data['course_id']);
    $data['course'] = $course->name;

    $student->update($data);

    return redirect()
        ->route('students.index')
        ->with('success', 'Student updated successfully!');
}


    // 7. Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
