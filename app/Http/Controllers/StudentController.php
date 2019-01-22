<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelsAuthentication\Student;
use App\Models\AuditProcess;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::find($id);
        return response()->json($students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        $students = Student::find($id);

        if($students){

            $students->update($request->all()); 

            $return = ['data' => ['msg' => 'Stundent atualizado com sucesso!']]; 

            return response()->json($return);

        }else{
            return response()->json('Houve um erro ao realizar operação de atualizar');
        }      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function auditStudents()
    {
        
        $students = Student::select('id', 'name', 'academic_register')->take(1000)->get();       

        foreach($students as $student) {
            
            $process = AuditProcess::where('student_id', $student->id)->where('status', '1')->get();

        }
       
        dd($process);

        foreach($students as $student) {
            
            $university = UniversityDegreeList::select('YEAR(date_conclusion)')->where('student_id', $student->id)->get();

        }

       return response($process,200);
    }
}
