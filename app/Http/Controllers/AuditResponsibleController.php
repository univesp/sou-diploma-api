<?php

namespace App\Http\Controllers;

use App\Models\AuditProcess;
use App\Models\AuditResponsible;
use App\Models\User;
use App\Models\UserTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditResponsibleController extends Controller
{
    public function responsibleProcess(Request $request)
    {
        //Count proccess from each analyst
        $nProcesses = DB::table('audit_processes')
            ->select('user_id')
            ->where('user_id', '=', $request->id)
            ->groupBy('user_id')
            ->count();

        //Validate academic_register
        $request->validate([
            'student_id' => 'required|max:7'
        ]);

        //verify if student is already atributted to some analyst
        $studentId = AuditProcess::where('academic_register', $request->academic_register)->first();

        //if yes, so the register is updated and a hystory is recorded on audit_responsible
        if (!empty($studentId)) {

            $auditHistory = AuditProcess::where('academic_register', $request->academic_register)->first();

            AuditResponsible::create([
                'audit_process_id' => $auditHistory->id,
                'user_id' => $auditHistory->user_id,
                'status' => $auditHistory->status,
                'attributed_date' => date('Y-m-d H:i:s', strtotime($auditHistory->attributed_date))
            ]);

            //
            $lastRegister = DB::table('audit_responsibles')
                ->select('user_id')
                ->latest()
                ->take(1)
                ->get();

            $lastResgisterArr = $lastRegister->toArray();
            $result = $lastResgisterArr[0]->user_id;

            $decProccess = DB::table('user_temp')
                ->where('id', '=', $result)
                ->take(1)
                ->get();

            $decProccessArr = $decProccess->toArray();
            $resultDec = $decProccessArr[0]->processes - 1;

            $dec = UserTemp::find($lastResgisterArr[0]->user_id);
            $dec->processes = $resultDec;
            $dec->save();

            $updateProccess = AuditProcess::find($studentId->id);
            $updateProccess->user_id = $request->id;
            $updateProccess->academic_register = $request->academic_register;
            $updateProccess->audit_type_id = 3;
            $updateProccess->status = "EM ANDAMENTO";
            $updateProccess->attributed_date = date('Y-m-d H:i:s');
            $updateProccess->save();

            //increment proccess register
            $nProcesses = $nProcesses + 1;

        } else {
            //if no, so a new register is recorded on audit_processes
            $auditProcess = new AuditProcess();
            $auditProcess->user_id = $request->id;
            $auditProcess->audit_type_status_id = 2;
            $auditProcess->academic_register = $request->academic_register;
            $auditProcess->student_id = $request->student_id;
            $auditProcess->audit_type_id = 3;
            $auditProcess->status = "EM ANDAMENTO";
            $auditProcess->attributed_date = date('Y-m-d H:i:s');
            $auditProcess->save();

            //increment proccess register
            $nProcesses = $nProcesses + 1;
        }

        $updateNProcesses = UserTemp::find($request->id);
        $updateNProcesses->processes = $nProcesses;
        $updateNProcesses->save();
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
