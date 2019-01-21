<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelsAuthentication\Student;
use App\Http\Requests\ParentageRequest;
use App\ModelsAuthentication\Parentage;
use App\ModelsAuthentication\ParentageType;

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
        $parentage = Parentage::find($id);

        if ($parentage) {
            //$parentagetyType = ParentageType::find($parentage->parentage_type_id);

            return $parentage = Parentage::find($id);
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
    public function update(ParentageRequest $request, $id)
    {
        // $students = Student::find($id);

        // foreach ($students->parentages as $parentage) {
        //     if ($parentage->parentage_type_id == 1) {
        //         $parentage->update($request->all());

        //         $return = ['data' => ['msg' => 'Nome atualizado com sucesso!']];

        //         return response()->json($return);
        //     }
        // }
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
