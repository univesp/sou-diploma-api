<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StudentCourseController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
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

    public function verifyLows($curso_id)
    {

        try {
            $data = DB::select('SELECT COUNT(a.accept_law) AS accept_law
                                FROM sou_audit.audit_processes a
                                JOIN sou_authentication.students b ON b.academic_register = a.academic_register
                                JOIN sou_authentication.classes c ON c.id = b.class_id
                                JOIN sou_authentication.courses co ON co.id = c.course_id
                                WHERE co.id = "{$curso_id}"');
        } catch (\Exception $ex) {
            return response(["Erro interno na Base de Dados: [{$ex->getMessage()}]"], 500);
        }

        if (!empty($data)) {
            return response($data, 200);
        } else {
            return response('Não foi encontrado aceitação da lei do curso na API de cursos.', 404);
        }
    }
}
