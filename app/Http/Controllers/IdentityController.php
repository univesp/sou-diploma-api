<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelsAuthentication\Student;
use App\Http\Requests\IdentityRequest;
use App\ModelsAuthentication\Identity;
use App\Services\IdentityAuditProcess;

class IdentityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $identity = Identity::paginate(10);
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

        if ($students) {
            return $students->identities->where('identity_type_id', 1);
        } else {
            return response()->json([
                'errors' => [
                'message' => 'Não encontrado',
                ],
            ], 404);
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

    //esse updade precisa do id do identity
    public function update(IdentityRequest $request, $id)
    {
        // Find identity by id
        $students = Student::find($id);

        //$students->identities->where('identity_type_id', 1)->first()->id
        //this line has the id Identity specific to update the title of elected
        $identity = Identity::find($students->identities->where('identity_type_id', 1)->first()->id);

        //instance a class with two parameter
        $ServiceIdentity = new IdentityAuditProcess($request->all(), $students, $identity);

        // // function that saves the field being updated.
        //$ServiceIdentity->storeSouAudit();

        if ($identity) {
            $identity->update($request->all());

            // Update al request of identity
            $return = ['data' => ['status' => true, 'msg' => 'Documento atualizado com sucesso.'], 200];

            return response()->json($return);
        } else {
            // Return error messages
            $return = ['data' => ['status' => false, 'msg' => 'Houve um erro ao atualizar o Documento.'], 404];

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
