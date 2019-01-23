<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\ModelsAuthentication\Student;
use App\Models\AuditProcess;
use App\Models\UniversityDegreeList;
use App\Erros;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $students = Student::find($id);

        if ($students) {
            return response()->json($students);
        } else {
            return response()->json([
                'errors' => [
                'message' => 'Não encontrado',
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
        // studant recebe o id passado pelo a rota
        $students = Student::find($id);

        if ($students) {
            $students->update($request->all());

            $return = ['data' => ['status' => true, 'msg' => 'Stundent atualizado com sucesso!'], 200];

            return response()->json($return);
        } else {
            return response()->json('Houve um erro ao realizar operação de atualizar', 404);
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
