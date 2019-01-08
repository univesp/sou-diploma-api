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
    <title>Título Opcional</title>
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
                <h2 style="color:red;margin-left:130px;">NOME DO DIPLOMADO</h2>
            </div>
            <div class="text-center" style="margin-top:10px;margin-left:120px;">
                de nacionalidade brasileira,<br/>
                portador da cédula de identidade RG XX.XXX.XXX-X SP,<br/>
                nascido em XX, XXXXXX de XXXX,<br/>
                e natural do Estado de São Paulo,<br/>
                o diploma do
                <b><h3>Curso Sequencial de Fundamentos da Docência nas<br/>
                    Áreas de Matemática, Ciências Naturias e Humanas</h3></b>
                    <p style="margin-top:-5px;">concluído em XXXXXX de XXXX<br/>
                    para que possa gozar dos direitos e prerrogativas legais,</p><br/>
                    <p style="margin-top:10px;"> São Paulo, XX de XXXXXX de XXXX.</p> 
               
            <div style="margin-top:50px;">  
                <div class="left sublinhado" style="margin-left:60px;">Patricia Laczynski de Souza<br/>Diretora Acadêmica</div>
                <div style="margin-right:200px;" class="sublinhado">Fernanda Adelaide Gouveia<br/>Presidente</div>
                <div style="clear:both"></div>
                <div class="right sublinhado">Diplomado(a)</div>       
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

            

        </style>
        <div class="bordas left">
            <p class="negrito p text-center size">UNIVERSIDADE VIRTUAL DO ESTADO DE SÃO PAULO - UNIVESP</p>
            <div class="margin">
            <p class="margin-bottom p">Secretaria de Registro Acadêmico - SR</p><br/>
            <p class="p">Diploma registrado sob n° 13072501202200001</p>
            <p class="p">rótulo n° GR.L.LB.000001.2018.1ª Via.00001</p>
            <p class="p">processo n° 2017.2.0001.02</p>
            <p class="margin-bottom p">nos termos do artigo 48 da lei 9.394, de 20/12/1996.</p>
            <br/>
            <p class="p"> São Paulo, 5 de dezembro de 2017</p>
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