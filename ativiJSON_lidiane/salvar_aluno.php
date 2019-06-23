<?php
include_once 'classes/conexao.php';
class Salva extends CONN
{
private $db;
public function __construct(){//construir a conexao com o banco
        $this->db = new CONN();//criando o objeto CONN
        $this->db = $this->db->Conn();//executando metodo e pondo em uma variavel
}
 function salva($vls){//metodo rebendo por parametro os valores
//sleep(2)tempo de espera de enivio da requisição;
$mensagens = [];
$contem_erros = false;

if ($vls['nome'] == '') {
  $contem_erros = true;
  $mensagens['nome'] = 'O nome está em branco';
}

if ($vls['idade'] == '') {
  $contem_erros = true;
  $mensagens['idade'] = 'A idade está em branco';
}
if ($vls['altura'] == '') {
            $erros = true;
            $mensagens['altura'] = "o altura esta em branco";
        }
        if (! $contem_erros) {//se não conter erros executara o inserir
          $id = null;
          $campos = "id_aluno, nome, altura, idade";
          $sql = "INSERT INTO `alunos`($campos) VALUES (:id, :nome,:altura,:idade)";
          $rs=$this->db->prepare($sql);
$rs->bindParam(':id',         $id , PDO::PARAM_INT);
$rs->bindParam(':nome',       $vls['nome'] , PDO::PARAM_STR);
$rs->bindParam(':altura',     $vls['altura'] , PDO::PARAM_STR);
$rs->bindParam(':idade',      $vls['idade'] , PDO::PARAM_STR);
$result = $rs->execute();


if ($result) {
    //passando vetor em forma de json
      $mensagens['sv'] = "salvo com sucesso!";
         echo json_encode([
            'mensagens' => $mensagens,
            'contem_erros' => false
          ]);//chama a funçaõ inserir na pagina acao.php

        }
      }else {
  // temos erros a corrigir
  echo json_encode([
    'contem_erros' => true,
    'mensagens' => $mensagens
  ]);
}
}
}
$nome = (string) $_REQUEST['nome'];//RECEBENDO os valores do index e pondo em variaveis
$altura = (string) $_REQUEST['altura'];
$idade  = (string) $_REQUEST['idade'];
$vls =  array('nome' => $nome,'altura' => $altura,'idade' => $idade);//os valore em variaveis colocando em array
$obj =new Salva;//cria o objeto salva desta pagina
$obj->salva($vls);//executa a função salva desta pagina e passsando os valores
