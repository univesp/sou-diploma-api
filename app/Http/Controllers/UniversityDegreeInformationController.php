<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models_authentication\Student;
use App\Models_authentication\Address;
use DB;

class UniversityDegreeInformationController extends Controller
{
    
    public function index()
    {
        return $students = Student::paginate(10);    
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
        
    }



}
