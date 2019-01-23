<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\ModelsAuthentication\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return students list with paginate
        return $students = Student::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        // Returnt all request
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find students by ids
        $students = Student::find($id);

        // Validation if students exists
        if ($students) {
            // Return students
            return response()->json($students);
        } else {
            // Return error messages
            return response()->json([
                'errors' => [
                'message' => 'Estudante não encontrado.',
                ],
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
         // Find students by ids
        $students = Student::find($id);

        // Validation if students exists
        if ($students) {
            // Update al request of students
            $students->update($request->all());

            // Return success messages
            $return = ['data' => ['status' => true, 'msg' => 'Estudante atualizado com sucesso!.'], 200];
            return response()->json($return);
        } else {
            // Return error messages
            return response()->json('Houve um erro ao atualizar o estudante.', 404);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
