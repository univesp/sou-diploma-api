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
    
        //dd($request->all());
        
        $teste = [$request];
        
        $rules = [
            'academic_register' => 'required|array',
            'academic_register.*' => 'exists:mysql_sa.students,academic_register', // check each item in the array
        ];
        
        $validator = Validator::make($teste[0]->academic_register, $rules);
        
        dd($validator->passes(), $validator->messages()->toArray());

        //########################################################################

        // $validator = Validator::make($request->all(), [
        //     'ras.*.ra' => 'required|size:7',
        // ]);  
           
        // if ($validator->fails()) {
        //     echo "<pre>";
        //     print_r($validator->messages());
        // }
        dd('=)');
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
        $studentsDegree = DB::connection('mysql_sa')->table('v_print_list_temp')->get();

        return response()->json($studentsDegree);

    }
    
}
