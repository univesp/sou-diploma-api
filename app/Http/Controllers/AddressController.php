<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelsAuthentication\Address;
use App\ModelsAuthentication\Student;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $address = Address::paginate(10);
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
        $students = Student::find($id);
        return $address = Address::find($students->address_id);
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
        $students = Student::find($id);

        $address = Address::find($students->address_id);

        if($address){

        $address->update($request->all());

        $return = ['data' => ['msg' => 'Stundent atualizado com sucesso!']]; 

        return response()->json($return);
        }
        else{
            return response()->json('Houve um erro ao realizar operação de atualizar');
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
