@php
DEFINE('PATH', __DIR__);
DEFINE('DS', DIRECTORY_SEPARATOR); 
$path = PATH. "".DS;
$path = "{$path}images". DS;
@endphp 
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DIPLOMADO</title>
    <style>
        #head{
            margin-top: 100%;
            max-width:100%; 
            max-height:100%;
            background-repeat: no-repeat;
            font-size: 25px;
            text-align: center;
            height: 100%;
            width : 100%;
            margin: 0 auto;
        }
        .right{
            float: right;
        }

        .sublinhado {
            border-top: solid 1px #000;
            width: 100px;
        }
    </style>
    </head>
    <body style="margin-top:-60px;">
        <div width="100%"><img id="head" src="{{ $path }}Diploma.png">
            <div class="text-center" style="margin-top:200px;">
                <p style="margin-left:120px;">A presidente da <b>Universidade Virtual do Estado de São Paulo,</b><br/>
                    no uso de suas atribuições, confere a</p>
            </div>
            <div class="text-center" style="margin-top:10px;">
            <h2 style="color:red;margin-left:130px;">{{ $universityDegree->name }}</h2>
            </div>
            <div class="text-center" style="margin-top:10px;margin-left:120px;">
                de nacionalidade brasileira,<br/>
                portador da cédula de identidade RG {{ $universityDegree->RG }} {{ $universityDegree->orgao_emissor }},<br/>
                nascido em {{ $universityDegree->day }}, {{ $universityDegree->mouth }} de {{ $universityDegree->year }},<br/>
                e natural do Estado de {{ $universityDegree->naturalidade }},<br/>
                o diploma do
                <b><h3>Curso {{ $universityDegree->course_name }}</h3></b>
            <p style="margin-top:-5px;">concluído em {{ $universityDegree->conclusion_mouth }} de {{ $universityDegree->conclusion_year }}<br/>
                    para que possa gozar dos direitos e prerrogativas legais,</p><br/>
                    <p style="margin-top:10px;"> São Paulo, {{ \Carbon\Carbon::now()->day }} de {{ \Carbon\Carbon::now()->month }} de {{ \Carbon\Carbon::now()->year }}.</p> 
               
            <div style="margin-top:50px;">
                <hr class="left" style="margin-left:60px;"/>  
                <div class="left" style="margin-left:60px;"><span class="sublinhado">Patricia Laczynski de Souza</span><br/>Diretora Acadêmica</div>
                
                <div style="margin-right:200px;"><span class="sublinhado">Fernanda Adelaide Gouveia</span><br/>Presidente</div>
                <div class="right " style="margin-top:-50px;"><span class="sublinhado">Diplomado(a)</span></div>
            </div>
        </div>

        <style>
            .bordas {
                border: solid 1px #000;
                width: 500px;
                margin-top: 130px;
            }
            .negrito {
                font-weight: bold;
            }
            .text-center{
                text-align: center;
            }
            .left{
            float: left;
            }
            .right{
            margin-right: 10%;
            margin-top: 20%;
            }
            .size{
                font-size: 14px;
            }
            .p{
                margin-top: 10px;
                line-height: 0.3;
            }
            .margin-bottom{
                margin-bottom: 15px;
            }
            .margin{
                margin-left: 30px;
            }

            .sublinhado {
                margin-bottom: border 1px #000;
            }

        </style>
        <div class="bordas left">
            <p class="negrito p text-center size">UNIVERSIDADE VIRTUAL DO ESTADO DE SÃO PAULO - UNIVESP</p>
            <div class="margin">
            <p class="margin-bottom p">Secretaria de Registro Acadêmico - SR</p><br/>
            <p class="p">Diploma registrado sob n° {{ $universityDegree->numero_diploma }}</p>
            <p class="p">rótulo n° {{ $universityDegree->numero_rotulo }}</p>

            <p class="p">processo n° {{ $universityDegree->numero_processo }}</p>
            <p class="margin-bottom p">nos termos do artigo 48 da lei 9.394, de 20/12/1996.</p>
            <br/>
            <p class="p"> São Paulo, {{ \Carbon\Carbon::now()->day }} de {{ \Carbon\Carbon::now()->month }} de {{ \Carbon\Carbon::now()->year }}.</p>
            </div>
            
            <br/>
            <p class="negrito p text-center">Leila Miguelina Aparecida Costa Somen</p>
            <p class="text-center p">Especialista em Sistemas Educacionais</p>
            <p class="text-center">Secretaria de Registro Acadêmico</p>
            <div class="margin">
            <p class="p">de acordo,</p>
            </div>
            <br/>
            <br/>
            <p class="negrito p text-center">Andrea Gonçalves Mariano Souza</p>
            <p class="text-center p">Coordenadora de Equipe Técnica</p>
            <p class="text-center p">Secretaria de Registro Acadêmico</p>
        </div>
    </body>
</html>