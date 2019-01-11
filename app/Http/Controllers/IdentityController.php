<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models_authentication\Address;
use App\Models_authentication\Student;
use App\Models_Authentication\Identity;
use App\Models_Authentication\IdentityType;

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
        return $identity = Identity::find($id);
        //return $identityType = IdentityType::find($identity->identity_type_id); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //esse updade precisa do id do identity
    public function update(Request $request, $id)
    {
        $identity = Identity::find($id);
        $identityType = IdentityType::find($identity->identity_type_id);
        if($identity){
        $identity->update($request->all());
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
