<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\ModelsAuthentication\Student;
use App\Models\AuditProcess;
use App\Models\UniversityDegreeList;
use App\Erros;
use DB;
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
    public function update(Request $request, $id)
    {
         // Find students by ids
        $students = Student::find($id);

        // Validation if students exists
        if ($students) {
            // Update al request of students
            $students->update($request->all());

        } else {
            // Return error messages
        }
        return response()->json('Houve um erro ao atualizar o estudante.', 404);
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
        try {
            $data = DB::select('SELECT
                                    p.id process_id,
                                    s.id student_id,
                                    s.academic_register ra_student,
                                    s.name student_name,
                                    st.audit_status_name,
                                    co.id course_id,
                                    co.name course_name,
                                    c.year_entry year_entry,
                                    YEAR ( l.date_conclusion ) year_conclusion,
                                    p.user_id
                                FROM sou_authentication.students s
                                JOIN sou_audit.university_degree_lists l ON s.id = l.student_id
                                JOIN sou_audit.audit_processes p ON p.academic_register = s.academic_register
                                JOIN sou_audit.type_status st ON p.audit_type_status_id = st.id
                                JOIN sou_authentication.classes c ON s.class_id = c.id
                                JOIN sou_authentication.courses co ON co.id = c.course_id
                                WHERE st.id = 1');

        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if(!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os dados da API de alunos auditados.', 200);
        }
    }
}
