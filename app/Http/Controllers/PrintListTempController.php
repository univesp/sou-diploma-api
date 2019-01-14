<?php

namespace App\Http\Controllers;

use App\PrintListTemp;
use Illuminate\Http\Request;

class PrintListTempController extends Controller
{
    public function printStatus(Request $request)
    {
        var_dump($request);

        $printStatus = PrintListTemp::find($request->id);
        $printStatus->status_impress = 1;
        $printStatus->save();

        $printStatus = PrintListTemp::where('student_id', $request->student_id);
        $printStatus->status_impress = 1;
        $printStatus->save();
    }
}
