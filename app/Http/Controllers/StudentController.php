<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    // 1. Display all students

    public function index(Request $request)
    {
        // Base query
        $query = Student::with('courseDetails.teacher');

        // Search students
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter by course
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // Filter by minimum marks
        if ($request->filled('min_marks')) {
            $query->where('marks', '>=', $request->min_marks);
        }

        // Retrieve paginated students
        $students = $query->latest()
            ->paginate(3)
            ->withQueryString();

        // Dashboard statistics (all students)
        $totalStudents = Student::count();

        $passedStudents = Student::where('marks', '>=', 40)->count();

        $failedStudents = Student::where('marks', '<', 40)->count();

        // Courses for filter dropdown
        $courses = Course::orderBy('name')->get();

        return view('students.index', compact(
            'students',
            'courses',
            'totalStudents',
            'passedStudents',
            'failedStudents'
        ));
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

            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);

        // Retrieve selected course

        $course = Course::findOrFail($data['course_id']);

        // Synchronize existing course column

        $data['course'] = $course->name;

        // Store profile image if uploaded

        if ($request->hasFile('profile_image')) {

            $data['profile_image'] = $request
                ->file('profile_image')
                ->store('students', 'public');

        }

        // Insert student record

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

        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

    ]);

    // Retrieve selected course

    $course = Course::findOrFail($data['course_id']);

    $data['course'] = $course->name;

    // Check whether a new image was uploaded

    if ($request->hasFile('profile_image')) {

        // Store the new image

        $newImage = $request
            ->file('profile_image')
            ->store('students', 'public');

        // Save new image path

        $data['profile_image'] = $newImage;

    }

    // Store the old image path

    $oldImage = $student->profile_image;

    // Update student record

    $student->update($data);

    // Delete old image only after successful update

    if (
        isset($newImage) &&
        $oldImage &&
        Storage::disk('public')->exists($oldImage)
    ) {

        Storage::disk('public')->delete($oldImage);

    }

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

    public function trashed()
    {
        $students = Student::onlyTrashed()
            ->latest('deleted_at')
            ->paginate(10);

        return view('students.trash', compact('students'));
    }

    public function restore($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);

        $student->restore();

        return redirect()
            ->route('students.trash')
            ->with('success', 'Student restored successfully!');
    }

    public function forceDelete($id)
{
    $student = Student::onlyTrashed()->findOrFail($id);

    // Retrieve image path

    $image = $student->profile_image;

    // Permanently delete student record

    $student->forceDelete();

    // Delete associated image

    if (
        $image &&
        Storage::disk('public')->exists($image)
    ) {

        Storage::disk('public')->delete($image);

    }

    return redirect()
        ->route('students.trash')
        ->with('success', 'Student permanently deleted!');
}


}
