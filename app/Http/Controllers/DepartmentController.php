<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Department::all();
        $departments = Department::paginate();
        return DepartmentResource::collection($departments);
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
    public function store(DepartmentCreateRequest $request)
    {
        // \Gate::authorize('edit', "users");

        $department = Department::create(
            $request->only('name')
        );

        return response(new DepartmentResource($department), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $Department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Department::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

     /**
     * @OA\Put(
     *   path="/departments/{id}",
     *   security={{"bearerAuth":{}}},
     *   tags={"Departments"},
     *   @OA\Response(response="202",
     *     description="Department Update",
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     description="Department ID",
     *     in="path",
     *     required=true,
     *     @OA\Schema(
     *        type="integer"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/DepartmentUpdateRequest")
     *   )
     * )
     */

    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        $department->update([
            'name' => $request->input('name')
        ]);

        return response($department, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

