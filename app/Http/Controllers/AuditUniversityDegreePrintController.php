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

        $universityDegree = DB::connection('mysql_sa')->table('v_impressao_diploma')->where('student_id',$student_id)->first();
        //numero_rotulo": "Undergraduation;bacharel;Licenciatura em Biologia;2;2018;1° via"
        $rotulo = explode(';',$universityDegree->numero_rotulo);
        
        if($rotulo[0] == 'Undergraduation') {
            $rotulo[0] = 'GR';
        }

        if($rotulo[1] == 'bacharel') {
            $rotulo[1] = 'B';
        }

        $rotulo[2] = 'LB';
        $rotulo[3] = '00002';
        $sequencial = $rotulo[3];

        $rotulo = "{$rotulo[0]}.{$rotulo[1]}.{$rotulo[2]}.{$rotulo[3]}.{$rotulo[4]}.{$rotulo[5]}.{$rotulo[3]}"; 

        $birth = explode("/",$universityDegree->birth_date);
        $conclusion = explode("/",$universityDegree->date_conclusion);

        $universityDegree->conclusion_mouth = $this->dayOrMouth($conclusion[1]);
        $universityDegree->conclusion_year  = $conclusion[2]; 

        $universityDegree->day = $birth[0];
        $universityDegree->mouth = $this->dayOrMouth($birth[1]);;
        $universityDegree->year = $birth[2];

        $universityDegree->numero_rotulo = $rotulo;

        //dd($universityDegree);

        $pdf = PDF::loadView('pdf.universityDegree', ['universityDegree' => $universityDegree])->setPaper('a4', 'landscape');

        return $pdf->download('Diploma - ' . Carbon::now()->format('H:i:s d-m-Y') . '.pdf');
    }

    private function dayOrMouth($day)
    {
        $mouth ='';
        switch($day) {
            case '01':
                $mouth = 'Janeiro';
            break;
            case '02':
                $mouth = 'Fevereiro';
            break;
            case '03':
                $mouth = 'Março';
            break;
            case '04':
                $mouth = 'Abril';
            break;
            case '05':
                $mouth = 'Maio';
            break;
            case '06':
                $mouth = 'Junho';
            break;
            case '07':
                $mouth = 'Julho';
            break;
            case '08':
                $mouth = 'Agosto';
            break;
            case '09':
                $mouth = 'Setembro';
            break;
            case '10':
                $mouth = 'Outubro';
            break;
            case '11':
                $mouth = 'Novembro';
            break;
            case '12':
                $mouth = 'Dezembro';
            break;
        }

        return $mouth;
    }

    public function printStatus(Request $request)
    {
        //dd($request);
        echo "OK!";
    }
}
