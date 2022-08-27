<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Student::all();
        $students = Student::with('department')->paginate();
        return StudentResource::collection($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentCreateRequest $request)
    {
        // \Gate::authorize('edit', "users");

        $student = Student::create(
            $request->only('name', 'batch_name', 'department_id')
        );

        return response(new StudentResource($student), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $Student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::with('department')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

     /**
     * @OA\Put(
     *   path="/students/{id}",
     *   security={{"bearerAuth":{}}},
     *   tags={"Students"},
     *   @OA\Response(response="202",
     *     description="Student Update",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="Student ID",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/StudentUpdateRequest")
     *   )
     * )
     */

    // public function update(StudentUpdateRequest $request, $id)
    // {
    //     // \Gate::authorize('edit', "users");

    //     $student = Student::find($id);

    //     $student->update($request->only('name', 'batch_name'));

    //     return response(new StudentResource($student), Response::HTTP_ACCEPTED);
    // }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $student->update([
            'name' => $request->input('name'),
            'batch_name' => $request->input('batch_name'),
        ]);

        return response($student, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

