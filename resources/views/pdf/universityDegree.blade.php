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
    </style>
    </head>
    <body style="margin-top:-60px;">
        <div width="100%"><img id="head" src="{{ $path }}Diploma.png">
            <div style="margin-top:200px;margin-left:350px;">
                <p>A presidente da Universidade Virtual do Estado de São Paulo,<br/>
                    no uso de suas atribuições, confere a</p>
            </div>
            <div style="margin-top:10px;margin-left:350px;">
                <h2 style="color:red">NOME DO DIPLOMADO</h2>
            </div>
            <div style="margin-top:10px;margin-left:350px;">
                de nacionalidae brasileira,<br/>
                portador da cédula de identidade RG XX.XXX.XXX-X SP,<br/>
                nascido em XX, XXXXXX de XXXX,<br/>
                e natural do Estado de São Paulo,<br/>
                o diploma do
                <b><h3>Curso Sequencial de Fundamentos da Docência nas<br/>
                    Áreas de Matemática, Ciências Naturias e Humanas</h3></b>
                    <p style="margin-top:5px;">concluído em XXXXXX de XXXX<br/>
                    para que possa gozar dos direitos e prerrogativas legais,</p><br/>
                    <p style="margin-top:10px;"> São Paulo, XX de XXXXXX de XXXX.</p> 
            </div>
            <div style="margin-left:180px;">
                <p>Prof. Dr. Cleide Marly Nébias<br/>Diretora Acadêmica</p>
            </div>
            <div style="margin-left:450px;margin-top:-100px;">
                <p >Fernanda Gouveia<br/>Presidente</p>
                <p style="margin-left:250px;margin-top:-100px;"><br/>Diplomado(a)</p>
            </div>
        <!-- {{ URL::asset('images/Diploma.png') }} <h1>DIPLOMA DE CONCLUÇÃO DO CURSO</h1> -->
        </div>
    </body>
</html>