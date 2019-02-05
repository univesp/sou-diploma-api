<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\ModelsAuthentication\Student;
use App\Services\StudentAuditProcess;
use Illuminate\Support\Facades\Input;
use App\Models\AuditProcess as AuditProcess;
use App\Models\DocumentType as DocumentType;
use App\Models\AuditDocument as AuditDocument;

class StudentController extends Controller
{
   
    public function index()
    {
        // Return students list with paginate
        return $students = Student::paginate(10);
    }

    public function store(Request $request)
    {
        // Send documents to storage
        $path_attachment = null;

        // Validate if file exist
        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $file = Input::file('attachment');
            $fileMimeType = Input::file('attachment')->getMimeType();
            $fileData = file_get_contents($file);
            $base64 = base64_encode($fileData);
            $path_attachment = "data:{$fileMimeType};base64,{$base64}";
        }

        // Find student by id
        $students = Student::all();
        
        foreach ($students as $student) {
            // Find audit process by student id
            $auditProcess = AuditProcess::where('student_id', $student->id)->first();
        }
        
        // Find document type by id
        $documentType = DocumentType::where('id', 1)->first();

        // Validation if audit proccess document type
        if ($auditProcess && $documentType) {
            
            // Create new audit document
            $auditDocument = new AuditDocument();
            $auditDocument->document_type_id = $documentType->id;
            $auditDocument->audit_process_id = $auditProcess->id;
            $auditDocument->attachment = $path_attachment;
    
            // Save audit document
            $auditDocument->save();

            // Return success messages
            $return = ['data' => ['status' => true, 'msg' => 'Documentos agregados com exito!.'], 200];
            return response()->json($return);
        } else {

            // Return error messages
            $return = ['data' => ['status' => false, 'msg' => 'Houve um erro ao agregar documentos.'], 404];
            return response()->json($return);
        }
   
    }
    
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
  
    public function update(StudentRequest $request, $id)
    {
        // Find students by ids
        $students = Student::find($id);
        //instance a class with two parameter
        $ServiceStudent = new StudentAuditProcess($request->all(), $students);
        // function that saves the field being updated.
        $ServiceStudent->storeSouAudit();

        // Validation if students exists
        if ($students) {
            // Update al request of students
            $students->update($request->all());

            // Return true messages
            $return = ['data' => ['status' => true, 'msg' => 'estudante atualizado com sucesso.'], 200];

            return response()->json($return);
        } else {
            // Return error messages
            $return = ['data' => ['status' => false, 'msg' => 'Houve um erro ao atualizar o estudante.'], 404];

            return response()->json($return);
        }
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

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os dados da API de alunos auditados.', 404);
        }
    }
    
    public function degreeStudents()
    {
        try {
            $data = DB::select('SELECT 
                                    p.id AS process_id,
                                    s.id AS student_id,
                                    s.academic_register AS ra_student,
                                    s.name AS student_name,
                                    (CASE p.status WHEN "AUDITADO" THEN "1"
                                    END) AS proc_status,
                                    p.status AS status,
                                    co.id AS course_id,
                                    co.name AS course_name,
                                    c.year_entry,
                                    YEAR(l.date_conclusion) AS year_conclusion,
                                    p.user_id
                                FROM sou_audit.audit_processes p
                                JOIN sou_audit.university_degree_lists l ON p.student_id = l.student_id
                                JOIN sou_authentication.students s ON s.id = p.student_id
                                JOIN sou_authentication.classes c ON s.class_id = c.id
                                JOIN sou_authentication.courses co ON co.id = c.course_id
                                WHERE p.status = "1"');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os dados da API de alunos diplomados.', 404);
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
            return response('Não encontramos os dados da API de Cursos.', 404);
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
            return response('Não encontramos os dados da API de Cursos em Aberto.', 404);
        }
    }

    public function attributedStudents()
    {
        try {
            $data = DB::select('SELECT 
                                    p.user_id,
                                    t.name,
                                    s.id student_id,
                                    s.academic_register,
                                    COUNT(p.user_id) AS "numeros de processos"
                                FROM sou_audit.audit_processes p
                                JOIN sou_audit.user_temp t ON t.id = p.user_id
                                LEFT JOIN sou_authentication.students s ON s.id = p.student_id
                                GROUP BY p.user_id');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos alunos atribuidos.', 404);
        }
    }

    public function dataPersonalStudents($academic_register)
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
                                    where s.academic_register = ' . $academic_register);

        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os dado pessoal do aluno.', 404);
        }
    }

    public function organIssuing($id = '')
    {
        $issui = $id ? " WHERE i.id = {$id}" : '';

        try {
            $data = DB::select('SELECT
                                    i.id,
                                    i.name
                                FROM sou_authentication.issuing_entities i
                                '.$issui.'
                                ORDER BY i.name');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos o orgão emissor do alunos.', 404);
        }
    }

    public function nationality($id = '')
    {
        $nationality = $id ? " WHERE c.id = {$id}" : '';

        try {
            $data = DB::select('SELECT
                                    c.id,
                                    c.portuguese_name
                                FROM sou_authentication.countries c
                                '.$nationality.'
                                ORDER BY c.portuguese_name');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos as nacionalidades do alunos.', 404);
        }
    }

    public function retained()
    {
    try {
            $data = DB::select('SELECT
                                    p.id AS process_id,
                                    s.id AS student_id,
                                    s.name AS student_name,
                                    co.name AS course_name,
                                    st.audit_status_name AS status,
                                    c.year_entry AS year_entry,
                                    YEAR (l.date_conclusion) AS year_conclusion,
                                    group_concat(i.field_name SEPARATOR ",") AS reason_retention,
                                    p.user_id
                                FROM sou_audit.audit_processes p
                                JOIN sou_audit.type_status st ON st.id = p.audit_type_status_id
                                JOIN sou_audit.university_degree_lists l ON p.student_id = l.student_id
                                JOIN sou_authentication.students s ON s.id = p.student_id
                                JOIN sou_authentication.classes c ON s.class_id = c.id
                                JOIN sou_authentication.courses co ON co.id = c.course_id
                                JOIN sou_audit.item_audit_processes i ON i.audit_process_id = p.id
                                WHERE st.id = 3 AND i.inconsistency = 1');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos alunos retidos.', 404);
        }
    }

    public function ticketData($academic_register = '')
    {

        $academic_register = $academic_register ? " WHERE s.academic_register = {$academic_register}" : '';

        try {
            $data = DB::select('SELECT
                                    s.id,
                                    co.name,
                                    "Graduação" AS nivel,
                                    l.name AS polo,
                                    c.year_entry,
                                    date_format(lu.date_conclusion, "%d/%c/%Y") AS date_conclusion,
                                    "Graduado" AS grau_conferido,
                                    date_format(lu.date_collation, "%d/%c/%Y") AS date_collation
                                FROM sou_authentication.students s
                                JOIN sou_authentication.classes c ON s.class_id = c.id
                                JOIN sou_authentication.locations l ON c.location_id = l.id
                                JOIN sou_authentication.courses co ON co.id = c.course_id
                                JOIN sou_audit.university_degree_lists lu ON lu.student_id = s.id
                                '. $academic_register);
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos alunos ingressados.', 404);
        }
    }

    public function city($id = '')
    {
        $city = $id ? " WHERE c.id = {$id}" : '';

        try {
            $data = DB::select('SELECT
                                    c.id,c.name
                                FROM sou_authentication.cities c
                                '.$city.'
                                ORDER BY c.name');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos as cidades.', 404);
        }
    }

    public function states($id = '')
    {
        $state = $id ? " WHERE e.id = {$id}" : '';

        try {
            $data = DB::select('SELECT
                                    e.id,e.uf
                                FROM sou_authentication.states e
                                '.$state.'
                                ORDER BY e.uf');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não encontramos os estados.', 404);
        }
    }
}
