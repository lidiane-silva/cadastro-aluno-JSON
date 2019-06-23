$(document).ready(function () {
          $("#form-aluno").on("submit",function (evento) {
                evento.preventDefault();
                var nome = $("[name = 'nome']").val();
                var altura = $("[name = 'altura']").val();
                var idade = $("[name = 'idade']").val();
                $('#erros').html('CARREGANDO....')
                $.ajax({
                    url: "salvar_aluno.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        'nome': nome,
                        'altura': altura,
                        'idade': idade
                    }

              }).done(function (resposta) {
                  $('#erros').empty();
                 // console.log(resposta);
                 if (resposta.contem_erros) {
                   //console.log(resposta.mensagens['sv']);
                     alert(resposta.mensagens['nome']);
                     alert(resposta.mensagens['idade']);
                     alert(resposta.mensagens['altura']);
                 }else{
                   console.log(resposta.contem_erros);
                    $('#erros').append(resposta.mensagens.sv);
                    location.reload(".lista-alunos");//atualiza o contener apos a execução com sucesso

                 }
              })
            $('#form-aluno').trigger("reset");//apaga os dados do formulario apos o envio
          })
      })
     function busca(busca) {
          $.ajax({
             url: "funcoes/funcoes.php",
             type: "POST",
             dataType: "json",
             data: {//tipo de dado
                 'busca':"busca"//botão pra inicia a ação
             }

  }).done(function (resposta) {
    console.log('encontrei ' + resposta.quant + ' registros');
  console.log(resposta.busca[0,'0'].nome, resposta.busca[0,'0'].altura);
  // console.log(resposta)
             if(resposta.erros){

                 for (let i = 0; i < resposta.quant; i++) {
                  // console.log($('.lista-alunos'))
                      $('.lista-alunos  th.id').append('<tr><td>'+resposta.busca[i]['0'] +'</td></tr>')
                      $('.lista-alunos  th.nome').append('<tr><td>'+resposta.busca[i]['1'] +'</td></tr>')
                      $('.lista-alunos  th.altura').append('<tr><td>'+resposta.busca[i]['2'] +'</td></tr>')
                      $('.lista-alunos  th.idade').append('<tr><td>'+resposta.busca[i]['3'] +'</td></tr>')


                 }
              //    setTimeout(location.reload(),1000)
                //  location.assign(index.html);

             }
         })
     }
     busca()
