<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IdentityRequest;
use App\ModelsAuthentication\Identity;
use App\ModelsAuthentication\IdentityType;

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
        $identity = Identity::find($id);

        if ($identity) {
            return $identity = Identity::find($id);
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
        $identity = Identity::find($id);

        $identityType = IdentityType::find($identity->identity_type_id);

        if ($identity) {
            $identity->update($request->all());

            $return = ['data' => ['success' => 'documento atualizado com sucesso!'], 200];

            return response()->json($return);
        } else {
            return response()->json('Houve um erro ao realizar operação de atualizar', 404);
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
