function GetQueryString(a) {
    a =
      a ||
      window.location.search
        .substr(1)
        .split("&")
        .concat(window.location.hash.substr(1).split("&"));
  
    if (typeof a === "string")
      a = a
        .split("#")
        .join("&")
        .split("&");
  
    if (!a) return {};
  
    var b = {};
    for (var i = 0; i < a.length; ++i) {
      var p = a[i].split("=");
  
      if (p.length != 2) continue;
  
      b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
    }
    return b;
  }
  
  $(document).ready(function() {
    var { ra, turma } = GetQueryString();
    $.get(
      "http://35.243.152.156:3201/api/v_print_list_temp?_where=(RA,eq," +
        ra +
        ")~and(class_id,eq," +
        turma +
        ")",
      function(resultado) {
        if (resultado.length) {
          $("#mensagem").addClass("success");
          var img = document.createElement("img");
          img.src = "../../images/valid.svg";
          img.alt = "Válido";
          img.classList.add("status-image");
          $("#mensagem").append(img);
          $("#msg").append(
            "Diploma: nº" +
              resultado[0].degree_number +
              "<br />Nome: " +
              resultado[0].nome_aluno +
              "<br />Curso: " +
              resultado[0].curso +
              "<br />Turma: " +
              resultado[0].class_id +
              "<br />Data de conclusão: " +
              resultado[0].data_conclusao
                .split("-")
                .reverse()
                .join("/") +
              "<br />RA: " +
              resultado[0].RA
          );
        } else {
          $("#mensagem").addClass("fail");
          var img = document.createElement("img");
          img.src = "../../images/invalid.svg";
          img.alt = "Inválido";
          img.classList.add("status-image");
          $("#mensagem").append(img);
          $("#msg").append(
            "Este diploma não foi encontrado em nossa base. Entre em contato com a secretária da Univesp para maiores informações."
          );
        }
      }
    );
  });