<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\API;
class PrintListTempController extends Controller
{
    /**
     * Autor: Eduardo Oliveira - 16-01-2019
     * Método index lista todos os estudantes aprovados para imprimir os diplomas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['prints'] = DB::connection('mysql_sa')->table('v_print_list_temp')->paginate(10);
            return response()->json($data,200);
        } catch (\Exception $e) {
            if(config('app.debug')) {
                return response()->json(API\ApiError::errorMessage($e->getMessage()),500);
            }
            return response()->json(API\ApiError::errorMessage("Ocorreu algum erro na operação!"),500);
        }       
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
    public function update(Request $request)
    {
        echo $request->ras;
        echo "<br/>";
        echo $request->id;
        echo "<br/>";
        echo $request->status;

        dd('@@@');

        $printStatus = PrintListTemp::whereIn('RA', $request->ras)->get();

        if($status) {
            foreach ($printStatus as $print) {
                $print->status_impress = $status;
                $print->save();
            }
        }
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
   
}
