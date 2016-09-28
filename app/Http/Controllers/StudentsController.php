<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Services\StudentService;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;

class StudentsController extends Controller
{
    /**
     * @var StudentService
     */
    private $studentService;

    /**
     * StudentsController constructor.
     * @param StudentService $studentService
     */
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

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

        $perPage = $request->per_page;

        $search = $request->search;

        $query = Student::orderBy($sortBy, $sortDirection);

        if ($search) {
            $like = "%{$search}%";

            $query = $query->where('name', 'LIKE', $like)
                ->orWhere('email', 'LIKE', $like);
        }

        return $query->paginate($perPage);
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
            $this->studentService->uploadAvatar($request, $student);
        }

        $this->studentService->saveStudent($request, $student);

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
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);

        if ($request->hasFile('avatar')) {
            $this->studentService->deleteCurrentAvatar($student);

            $this->studentService->uploadAvatar($request, $student);
        }

        $this->studentService->saveStudent($request, $student);

        return response(null, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $this->studentService->deleteCurrentAvatar($student);

        Student::destroy($id);
    }
}
