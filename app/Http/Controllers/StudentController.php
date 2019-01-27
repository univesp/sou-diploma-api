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

    public function reserchStudents()
    {

        try {
             $data = DB::select('SELECT
                                    co.id,
                                    co.name,
                                    c.year_entry,
                                    ( c.year_entry + ( co.duration_semesters / 2 ) ) AS ano_conclusao,
                                    count( 1 ) AS TT
                                FROM sou_audit.university_degree_lists l
                                JOIN sou_authentication.students s ON s.id  = l.student_id
                                JOIN sou_authentication.classes  c ON c.id  = s.class_id
                                JOIN sou_authentication.courses co ON co.id = c.course_id
                                GROUP BY co.id, co.name, c.year_entry, ano_conclusao');

        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os dados da API de Cursos.', 200);
        }
    }

    public function openedStudents()
    {

        try {
            $data = DB::select('SELECT
                                    co.id AS course_id,
                                    co.name AS name_course,
                                    s.id AS student_id,
                                    s.name,
                                    s.gender,
                                    date_format(s.birth_date, "%d/%c/%Y") AS birth_date,
                                    s.academic_register AS academic_register,
                                    ifnull(ap.status, 0) AS proc_status,
                                    lo.name AS polo,
                                    concat(c.year_entry, ".", c.semester) AS year_entry,
																		date_format(l.date_conclusion, "%d/%c/%Y") AS year_conclusion,
                                    concat(YEAR(l.date_conclusion), ".",
                                    IF((MONTH(l.date_conclusion) <= 6), "1","2") ) AS semester_conclusion,
                                    ap.user_id AS user_id
                                FROM sou_audit.university_degree_lists l
                                JOIN sou_authentication.students s     ON s.id  = l.student_id
					            JOIN sou_authentication.classes c      ON c.id  = s.class_id
								JOIN sou_authentication.courses co     ON co.id = c.course_id
			                    JOIN sou_authentication.locations lo   ON lo.id = c.location_id
				                LEFT JOIN sou_audit.audit_processes ap ON ap.academic_register = s.academic_register
                                WHERE l.status = 0  OR ap.status = "ABERTO"');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os dados da API de Cursos em Aberto.', 200);
        }
    }

    public function attributedStudents()
    {

        try {
            $data = DB::select('SELECT
                                    p.user_id, t.name, count(p.user_id) as "numeros de processos"
                                FROM audit_processes p
                                JOIN user_temp t on t.id = p.user_id
                                GROUP BY p.user_id');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos alunos atribuidos.', 200);
        }

    }

    public function dataPersonalStudents($id_students)
    {

        try {
            $data = DB::select('SELECT
                                    s.id,
                                    s.academic_register,
                                    s.name,
                                    s.assumed_name,
                                    s.cpf,
                                    s.countriy_id,
                                    s.city_id,
                                    c.name AS naturalidade,
                                    ad.id AS adress_id,
                                    ad.street,
                                    ad.zipcode,
                                    ad.street_number,
                                    ad.street_complement,
                                    ad.city_id AS city_adress,
                                    ad.state,
                                    ad.neighborhood,
                                    m.name AS mothers_name,
                                    p.name AS fathers_name,
                                    (SELECT sou_authentication.identities.id
                                        FROM sou_authentication.identities
                                        JOIN sou_authentication.student_x_identify ON sou_authentication.identities.id = sou_authentication.student_x_identify.identity_id
                                        WHERE sou_authentication.student_x_identify.student_id = s.id AND sou_authentication.identities.identity_type_id = 12) AS rg_id,
                                    (SELECT sou_authentication.identities.number
                                        FROM sou_authentication.identities
                                        JOIN sou_authentication.student_x_identify ON sou_authentication.identities.id = sou_authentication.student_x_identify.identity_id
                                        WHERE sou_authentication.student_x_identify.student_id = s.id AND sou_authentication.identities.identity_type_id = 12) AS rg_number,
                                    (SELECT sou_authentication.issuing_entities.id
                                        FROM sou_authentication.identities
                                        JOIN sou_authentication.student_x_identify ON sou_authentication.identities.id = sou_authentication.student_x_identify.identity_id
                                        JOIN sou_authentication.issuing_entities ON sou_authentication.issuing_entities.id = sou_authentication.identities.issuing_entity_id
                                        WHERE sou_authentication.student_x_identify.student_id = s.id AND  sou_authentication.identities.identity_type_id = 12) AS rg_orgao_id,
                                    (SELECT sou_authentication.issuing_entities.name
                                        FROM sou_authentication.identities JOIN sou_authentication.student_x_identify ON sou_authentication.identities.id = sou_authentication.student_x_identify.identity_id
                                        JOIN sou_authentication.issuing_entities ON sou_authentication.issuing_entities.id = sou_authentication.identities.issuing_entity_id
                                        WHERE sou_authentication.student_x_identify.student_id = s.id AND sou_authentication.identities.identity_type_id = 12) AS rg_orgao,
                                    (SELECT sou_authentication.identities.id
                                        FROM sou_authentication.identities JOIN sou_authentication.student_x_identify ON sou_authentication.identities.id = sou_authentication.student_x_identify.identity_id
                                        WHERE sou_authentication.student_x_identify.student_id = s.id AND sou_authentication.identities.identity_type_id = 1) AS titulo_id,
                                    (SELECT sou_authentication.identities.number
                                        FROM sou_authentication.identities
                                        JOIN sou_authentication.student_x_identify ON sou_authentication.identities.id = sou_authentication.student_x_identify.identity_id
                                        WHERE sou_authentication.student_x_identify.student_id = s.id AND sou_authentication.identities.identity_type_id = 1) AS titulo_number,
                                    (SELECT sou_authentication.emails.id
                                        FROM sou_authentication.emails
                                        JOIN sou_authentication.student_x_emails ON sou_authentication.emails.id = sou_authentication.student_x_emails.email_id
                                        WHERE sou_authentication.emails.email_type = "PESSOAL" AND sou_authentication.student_x_emails.student_id = s.id) AS email_id,
                                    (SELECT sou_authentication.emails.email
                                        FROM sou_authentication.emails
                                        JOIN sou_authentication.student_x_emails ON sou_authentication.emails.id = sou_authentication.student_x_emails.email_id
                                        WHERE sou_authentication.emails.email_type = "PESSOAL" AND sou_authentication.student_x_emails.student_id = s.id) AS email_pessoal,
                                    (SELECT sou_authentication.emails.id
                                        FROM sou_authentication.emails
                                        JOIN sou_authentication.student_x_emails ON sou_authentication.emails.id = sou_authentication.student_x_emails.email_id
                                    WHERE sou_authentication.emails.email_type = "INSTITUCIONAL" AND sou_authentication.student_x_emails.student_id = s.id) AS email_inst_id,
                                    (SELECT sou_authentication.emails.email
                                        FROM sou_authentication.emails
                                        JOIN sou_authentication.student_x_emails ON sou_authentication.emails.id = sou_authentication.student_x_emails.email_id
                                        WHERE sou_authentication.emails.email_type = "INSTITUCIONAL" AND sou_authentication.student_x_emails.student_id = s.id) AS email_inst
                                    FROM sou_authentication.students s
                                    JOIN sou_authentication.addresses ad ON ad.id = s.address_id
                                    LEFT JOIN sou_authentication.cities c ON s.city_id = c.id
                                    JOIN (SELECT sp.student_id,p.name
                                            FROM sou_authentication.student_x_parentage sp
                                            JOIN sou_authentication.parentages p ON sp.parentage_id = p.id
                                            WHERE p.parentage_type_id = 1
                                    ) m ON m.student_id = s.id
                                    JOIN (SELECT sp.student_id,p.name
                                            FROM sou_authentication.student_x_parentage sp
                                            JOIN sou_authentication.parentages p ON sp.parentage_id = p.id
                                            WHERE p.parentage_type_id = 2
                                    ) p ON p.student_id = s.id
                                    where s.id = ' . $id_students);
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os dado pessoal do aluno.', 200);
        }
    }


}
