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
  <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/degree.js') }}"></script>
    <div id="mensagem"><div id="msg">
    </div>
        <input type="hidden" name="ra" value="{{ $data['ra'] }}" />
        <input type="hidden" name="turma" value="{{ $data['turma'] }}" />
    </div>
  </body>
</html>