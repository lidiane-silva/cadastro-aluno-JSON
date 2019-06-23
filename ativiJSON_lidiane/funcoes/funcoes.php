<?php
include_once '../classes/conexao.php';
class Acao extends CONN
{
private $db;
private $acao;
  //contrução da conexão
public function __construct(){
        $this->db = new CONN();
        $this->db = $this->db->Conn();
 }


  function seleciona()
  {
    if ($_POST['busca']) {
    $qry ="SELECT * FROM alunos";//colocando na variavel o comando de seleção
     $rs=$this->db->query($qry)->fetchAll();//efetuando a seleção
     $dados = count($rs);//contantos as linas contidas no bd
  //  echo($dados)."<br>";

  /*  foreach ($rs as $key){
      echo 'Código: ' . $key['id_usuario'] . '<br />';
      echo 'Nome: ' . $key['nome'] . '<br /><br />';
      echo 'altura: ' . $key['altura'] . '<br /><br />';
      echo 'idade: ' . $key['idade'] . '<br /><br />';
    }*/
    //Passando vetor em forma de json
    echo json_encode([
          'busca'=> $rs,
          'erros' => true,
          'quant'=>$dados
      ]);
    }
    //echo json_encode($rs);
  }
}




$acao= new Acao();
echo $acao->seleciona();


  ?>
