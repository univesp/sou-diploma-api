<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuditUniversityDegreePrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function ReportPdf() 
    {

        $student_id = 65537;

        //$data = DB::connection('mysql_sa')->table('v_impressao_diploma')->where('student_id',$student_id)->get();
        
        //dd($data);

        $universityDegree = [];
        
        $pdf = PDF::loadView('pdf.universityDegree', ['universityDegree' => $universityDegree])->setPaper('a4', 'landscape');

        return $pdf->download('Diploma - ' . Carbon::now()->format('H:i:s d-m-Y') . '.pdf');
    }
}
