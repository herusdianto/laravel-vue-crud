<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->sort;
        $sort = explode('|', $sort);

        $sortBy = $sort[0];
        $sortDirection = $sort[1];

        $page = $request->page;

        $per_page = $request->per_page;

        $search = $request->search;

        $query = Student::orderBy($sortBy, $sortDirection);

        if ($search) {
            $query = $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        return $query->paginate($per_page);
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
     * @param CreateStudentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudentRequest $request)
    {
        $student = new Student();

        if ($request->hasFile('avatar')) {
            $fileName = str_random(30);
            $extension = $request->avatar->extension();
            $fullFileName = "{$fileName}.{$extension}";

            if($request->avatar->storeAs('public/avatars', $fullFileName)) {
                $student->avatar = $fullFileName;
            }
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->birth_date = $request->birth_date;
        $student->save();

        return response(null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
