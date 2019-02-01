<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelsAuthentication\Student;
use App\Http\Requests\ParentageRequest;
use App\ModelsAuthentication\Parentage;
use App\Services\ParentageAuditProcess;

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
        $students = Student::find($id);

        $students->parentages->where('parentage_type_id');
        //$parentage = Parentage::where('gender', $id)->get();

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
    public function update(ParentageRequest $request, $id, $type)
    {
        if ($type >= 1 && $type <= 2) {
            $students = Student::find($id);

            $idParentage = $students->parentages->where('parentage_type_id', $type)->first()->id;

            $parentage = Parentage::find($idParentage);

            $ServiceParentage = new ParentageAuditProcess($request->all(), $students, $parentage);

            $ServiceParentage->storeSouAudit();

            if ($type = 1) {
                // Update all request.
                $parentage->update($request->all());

                $return = ['data' => ['status' => true, 'atualizado com sucesso!'], 200];

                return response()->json($return);
            } else {
                $return = ['data' => ['status' => false, 'msg' => 'Houve um erro ao atualizar.'], 404];

                return response()->json($return);
            }
        } else {
            $return = ['data' => ['status' => false, 'msg' => 'Você precisa fornecer o tipo 1 atualiza a mãe 2 o pai.', 404]];

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
