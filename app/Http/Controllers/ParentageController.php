<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models_Authentication\Parentage;
use App\Models_Authentication\Student;
use App\Models_Authentication\Parentage_types;

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
        $parentage = Parentage::find($id);
        $parentagetyType = Parentage_types::find( $parentage->parentage_type_id);
        return $parentagetyType;
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
        //$parentage = Parentage::find($id);
        //dd($parentage);
        // $parentagetyType = Parentage_types::find($parentage->parentage_type_id, 1);
        // return $parentagetyType;
        $student = Student::find($id);
        
        foreach ($student->parentages as $parentage) {
            if($parentage->parentage_type_id == 1){
                $parentage->update($request->all());
            }else{
                
            }
        }
    
        // $student->parentages()->sync($student->parentages);
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
