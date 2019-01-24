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

        // ,co.id course_id, co.name course_name, c.year_entry
        // left join sou_authentication.classes c on c.id = s.class_id
        // left join sou_authentication.courses co on co.id = c.course_id

        $data = DB::select('select
                                p.id process_id, p.user_id, st.audit_status_name,
                                s.id student_id, s.academic_register ra_student, s.name student_name
                            from sou_authentication.students s
                            join sou_audit.audit_processes p on p.academic_register = s.academic_registery
                            join sou_audit.type_status st on p.audit_type_status_id = st.id
                            limit 100');

        return response($data, 200);

    }
}
