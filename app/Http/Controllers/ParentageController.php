<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ParentageRequest;
use App\ModelsAuthentication\Parentage;

class ParentageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $parentage = Parentage::paginate(10);
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
        $parentage = Parentage::where('gender', $id)->get();

        if ($parentage) {
            return response()->json($parentage);
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
    public function update(ParentageRequest $request, $id)
    {
        // para atualizar o nomes do pais, você vai precisa dos ids de cada uma deles no metédo show passando o id do stuand você vai ter como o resultado o id do pai e mãe associado a o estudante.
        $parentage = Parentage::find($id);

        if ($parentage) {
            if ($parentage->parentage_type_id == 1) {
                $parentage->update($request->all());

                $return = ['data' => ['status' => true, 'mãe' => 'atualizado com sucesso!'], 200];

                return response()->json($return);
            } else {
                $parentage->update($request->all());

                $return = ['data' => ['status' => true, 'pai' => 'atualizado com sucesso!'], 200];

                return response()->json($return);
            }
        } else {
            return response()->json(['errors' => ['message' => 'Não realizar esse operação']], 404);
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
