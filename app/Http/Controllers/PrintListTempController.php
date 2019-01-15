<?php

namespace App\Http\Controllers;

use App\Models\PrintListTemp;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintListTempController extends Controller
{
    public function printStatus(Request $request)
    {
//        var_dump($request);

//        $printStatus = PrintListTemp::where('ra', '=', $request->student_id)->first();
//        $printStatus->status_impress = 1;
//        $printStatus->save();

//        $printStatus = DB::table('print_list_temp')->whereIn('RA', $request->ras)->get();

        $printStatus = PrintListTemp::whereIn('RA', $request->ras)->get();

        foreach ($printStatus as $print){
            $print->status_impress = 1;
            $printStatus->save();
        }

//        if ($printStatus) {
//            return response()->json([
//                'Message' => 'Impressão comcluída com sucesso!'
//            ]);
//        }else{
//            return response()->json([
//                'Message' => 'Falha na impressão!'
//            ]);
//        }
    }

    public function getStudentsDegreePrint()
    {
        $studentsDegree = DB::connection('mysql_sa')->table('v_print_list_temp')->get();

        return response()->json($studentsDegree);

    }
}
