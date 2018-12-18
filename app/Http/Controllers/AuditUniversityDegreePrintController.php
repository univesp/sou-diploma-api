<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
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
        $universityDegree = [];
        
        $pdf = PDF::loadView('pdf.universityDegree', ['universityDegree' => $universityDegree])->setPaper('a4', 'landscape');

        return $pdf->download('Diploma - ' . Carbon::now()->format('H:i:s d-m-Y') . '.pdf');
    }
    
    public function getPdf() 
    {
        $universityDegree = [];
        return view('pdf.universityDegree', compact('universityDegree'));
    }

    public function universityDegreeWeb()
    {
        $universityDegreeWeb = array();

        return view('pdf.universityDegreeWeb', compact('universityDegreeWeb'));
    }
}
