<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $data = [
            'ra' => $temp[0],
            'turma' => $request->query('turma'),
        ];

        return view('degree.degree', compact('data'));
    }
}
