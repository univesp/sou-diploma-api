<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models_authentication\Student;
use App\Models_authentication\Address;
use App\Models_authentication\Identity;
use App\Models_authentication\IdentityType;

use DB;

class UniversityDegreeInformationController extends Controller
{
    
    public function index()
    {
        return $students = Student::paginate(10);
        //return $identity = Identity::paginate(10); 
        //return $TypeDocument = Identity_types::paginate(10);
    }

    public function updateStudents(Request $request, $id)
    {
        $students = Student::find($id);   
        
        if($students){
           $students->update($request->all());    
        }

        $address = Address::find($students->address_id);

        if($address){
            $address->update($request->all());
        }
 
        $student = DB::select('select  s.name, i.number , t.name
                from students s
                left join student_x_identify si
                on  si.student_id = s.id 
                left join identities i 
                on i.id = si.identity_id
                left join identity_types t 
                on t.id = i.identity_type_id 
                where s.id = ? and t.id = ?', [$id, 1]);
        
        //$student->save();

    }



}