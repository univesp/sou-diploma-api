<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="{{ asset('css/css.css') }}" rel="stylesheet"/>
    <title>Validador de diploma</title>
    <link rel="stylesheet" href="{{ asset('css/degree.css') }}" />
  </head>
  <body>
    <div id="mensagem" class = "{{ !empty($data['0']) ? 'success' : 'fail' }}">
        <img src="{{ !empty($data['0']) ? asset('images/valid.svg') : asset('images/invalid.svg') }}" alt="{{ !empty($data['0']) ? 'Válido' : 'Inválido' }}" class="status-image"/>
        <div id="msg">
            @if(!empty($data['0']))
                Diploma: nº  {{ $data[0]->degree_number }}
                <br />Nome:  {{ $data[0]->nome_aluno }}
                <br />Curso: {{ $data[0]->curso }}
                <br />Turma: {{ $data[0]->class_id }}
                <br />Data de conclusão: {{ $data[0]->data_conclusao }}
                <br />RA: {{ $data[0]->RA }}
            @else 
                Este diploma não foi encontrado em nossa base. Entre em contato com a secretária da Univesp para maiores informações.
            @endif
        </div>
    </div>
  </body>
</html>