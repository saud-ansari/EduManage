<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Course;
use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display all students
    public function index()
    {
        $students = Student::with('courseDetails')
            ->latest()
            ->paginate(10);

        return StudentResource::collection($students);
    }

    // Create a student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'marks' => 'required|integer',
            'date_of_birth' => 'nullable|date',
            'profile_image' => 'nullable|string|max:255'
        ]);

        $course = Course::findOrFail($validated['course_id']);

        $validated['course'] = $course->name;

        $student = Student::create($validated);

        return (new StudentResource($student->load('courseDetails')))
            ->response()
            ->setStatusCode(201);
    }

    // Display one student
    public function show(string $id)
    {
        $student = Student::with('courseDetails')->findOrFail($id);

        return new StudentResource($student);
    }

    // Update a student
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'phone' => 'sometimes|required|string|max:255',
            'course_id' => 'sometimes|required|exists:courses,id',
            'marks' => 'sometimes|required|integer',
            'date_of_birth' => 'sometimes|nullable|date',
            'profile_image' => 'sometimes|nullable|string|max:255'
        ]);

        if (isset($validated['course_id'])) {
            $course = Course::findOrFail($validated['course_id']);
            $validated['course'] = $course->name;
        }

        $student->update($validated);

        return new StudentResource(
            $student->fresh('courseDetails')
        );
    }

    // Delete a student
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ], 200);
    }
}
