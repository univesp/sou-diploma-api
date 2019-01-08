<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RegistrationController extends Controller
{
    public function index() {

        // TODO: CONSULT BY ID
        $students = DB::connection('mysql_sa')
            ->table('students')
            ->where('id', 65536)
            ->first();

        // TODO: CONSULT BY ID WITH PIVOT TABLE
        $students = DB::connection('mysql_sa')->select('
            SELECT students.name, emails.email 
            FROM student_x_emails 
                INNER JOIN students
                    ON student_x_emails.student_id = students.id
                INNER JOIN emails
                    ON student_x_emails.email_id = emails.id
            WHERE students.id = 65536'
        );

        return view ('registration.index')
            ->with('students', $students);
    }

    public function update(Request $request, $id) {
        // Session
        $user_id = $request->session()->get('user')['id'];

        // TODO: SAVE SIMPLE FIELD
        $student = DB::connection('mysql_sa')
            ->table('students')
            ->where('id', $user_id)
            ->first();

        $student->name = $request->name;
        $student->save();
        
        // TODO: SAVE WITH PIVOT TABLE
        $student = DB::connection('mysql_sa')->select('
            UPDATE students
                INNER JOIN student_x_emails
                    ON student_x_emails.student_id = students.id
                INNER JOIN emails
                    ON student_x_emails.email_id = emails.id
            SET students.name =' .$student->name.'
            WHERE students.id =' .$user_id
        );
        
        return json($student);
    }
}
