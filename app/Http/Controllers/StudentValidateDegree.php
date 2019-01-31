<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StudentValidateDegree extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Request
     * @return Array
     */
    public function show(Request $request)
    {

        $temp = explode('/?', $request->query('ra'));

        $ra = $temp[0];
        $class = $request->query('turma');

        $data = DB::connection('mysql')->select('select * from print_list_temp where ra = :ra and class_id = :class_id', ['ra' => $ra, 'class_id' => $class]);

        return view('degree.degree', compact('data'));
    }
}
