<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\ModelsAuthentication\Student;
<<<<<<< HEAD
use App\Models\AuditProcess;
use App\Models\UniversityDegreeList;
use App\Erros;
=======
>>>>>>> upstream/devel

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
<<<<<<< HEAD
    public function update(Request $request, $id)
    {
        $students = Student::find($id);

        if($students){

            $students->update($request->all());

            $return = ['data' => ['msg' => 'Stundent atualizado com sucesso!']];
=======
    public function update(StudentRequest $request, $id)
    {
         // Find students by ids
        $students = Student::find($id);

        // Validation if students exists
        if ($students) {
            // Update al request of students
            $students->update($request->all());
>>>>>>> upstream/devel

            // Return success messages
            $return = ['data' => ['status' => true, 'msg' => 'Estudante atualizado com sucesso!.'], 200];
            return response()->json($return);
<<<<<<< HEAD

        }else{
            return response()->json('Houve um erro ao realizar operação de atualizar');
=======
        } else {
            // Return error messages
            return response()->json('Houve um erro ao atualizar o estudante.', 404);   
>>>>>>> upstream/devel
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

    public function auditStudents()
    {

        $result = DB::select('*')
            ->from('sou_audit.audit_processes')
            ->join('sou_authentication.students', function ($join) {
                $join->on('sou_audit.audit_processes.student_id', '=', 'sou_authentication.students.id')->where('audit_type_status_id', '1');
            })
            ->take(1)->get();

        return response($result, 200);

        $process = AuditProcess::where('audit_type_status_id', '1')->get();

        $university = UniversityDegreeList::all();

        $students = Student::select('id', 'name', 'academic_register')->get();

        return response($university, 200);

    }
}
