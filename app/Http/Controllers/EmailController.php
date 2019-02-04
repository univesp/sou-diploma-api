<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelsAuthentication\Email;
use App\Services\EmailAuditProcess;
use App\ModelsAuthentication\Student;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::find($id);

        $students->emails->where('email_type');

        if ($students) {
            return response()->json($students);
        } else {
            return response()->json(['errors' => ['message' => 'Não realizar esse operação']], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {
        //verification type
        if ($type >= 0 && $type <= 1) {
            // id student
            $students = Student::find($id);
            //how id of student this idParentage variable searches the database for the specific Parentage id
            $idEmail = $students->emails->where('email_type', $type)->first()->id;
            //id related to studying
            $email = Email::find($idEmail);
            //instance a class with two parameter
            $ServiceEmail = new EmailAuditProcess($request->all(), $students, $email);
            // function that saves the field being updated.
            $ServiceEmail->storeSouAudit();
            //this if verifies which type of mail will be updated.
            if ($type = 1) {
                // Update all request.
                $email->update($request->all());

                $return = ['data' => ['status' => true, 'atualizado com sucesso!'], 200];

                return response()->json($return);
            } else {
                $return = ['data' => ['status' => false, 'msg' => 'Houve um erro ao atualizar.'], 404];

                return response()->json($return);
            }
        } else {
            $return = ['data' => ['status' => false, 'msg' => 'Você precisa fornecer o tipo se for 0 atualizar o email pessoal e se for 1 atualizar o email escolar.', 404]];

            return response()->json($return);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
