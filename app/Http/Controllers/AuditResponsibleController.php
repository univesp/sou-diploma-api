<?php

namespace App\Http\Controllers;

use App\Models\AuditProcess;
use App\Models\AuditResponsible;
use Illuminate\Http\Request;

class AuditResponsibleController extends Controller
{
    public function responsibleProcess(Request $request)
    {
        $studentId = AuditProcess::where('student_id',$request->student_id)->first();

        $request->validate([
            'student_id' => 'required|max:7'
        ]);

        if (!empty($studentId)){
            $auditHistory  = AuditProcess::where('student_id', $request->student_id)->first();

            AuditResponsible::create([
                'audit_process_id' => $auditHistory->id,
                'user_id' => $auditHistory->user_id,
                'status' => $auditHistory->status,
                'attributed_date' => date('Y-m-d H:i:s', strtotime($auditHistory->attributed_date))
            ]);

            $updateProccess = AuditProcess::find($studentId->id);
            $updateProccess->user_id = $request->id;
            $updateProccess->student_id = $request->student_id;
            $updateProccess->audit_type_id = 3;
            $updateProccess->status = "EM ANDAMENTO";
            $updateProccess->attributed_date = date('Y-m-d H:i:s');
            $updateProccess->save();

        }else{
            $auditProcess = new AuditProcess();
            $auditProcess->user_id = $request->id;
            $auditProcess->student_id = $request->student_id;
            $auditProcess->audit_type_id = 3;
            $auditProcess->status = "EM ANDAMENTO";
            $auditProcess->attributed_date = date('Y-m-d H:i:s');
            $auditProcess->save();
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
}
