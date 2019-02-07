<?php

namespace App\Http\Controllers;

use App\Models\PrintListTemp;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class PrintListTempController extends Controller
{
    public function index()
    {
        $studentsDegree = DB::connection('mysql_sa')->table('v_print_list_temp')->get();

        return response()->json($studentsDegree);
    }

    public function printStatus(Request $request)
    {
        foreach($request->ras as $r) {
            $ras['academic_register'][] = $r;
        }

        $rules = [
            'academic_register' => 'required|array',
            'academic_register.*' => 'exists:mysql_sa.students,academic_register',

        ];

        $validator = Validator::make($ras, $rules);
        $errors = array();

        foreach($validator->messages()->toArray() as $erros) {
            foreach($erros as $e){
                $errors['errors'][] = $e;
            }
        }        

        $printStatus = PrintListTemp::whereIn('RA', $request->ras)->get();

        foreach ($printStatus as $print){
            $print->status_impress = 1;
            $print->save();
        }
    }

    public function printFail(Request $request)
    {
        $printStatus = PrintListTemp::whereIn('RA', $request->ras)->get();

        foreach ($printStatus as $print){
            $print->status_impress = 0;
            $print->save();
        }
    }

    public function getStudentsDegreePrint()
    {
		
        //$studentsDegree = DB::connection('mysql_sa')->table('v_print_list_temp')->get();
		$studentsDegree = DB::select('SELECT u.*
										FROM sou_audit.university_degree_prints u
										INNER JOIN sou_audit.print_list_temp t ON t.id_legacy = u.id_legacy
										GROUP BY 1');
										
        return response()->json($studentsDegree);

    }

}
