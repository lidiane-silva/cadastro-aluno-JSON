<?php

 class CONN{
 public function  Conn(){
    try
        {
          //Conectando ao banco de dados
            $con = new PDO("mysql:host=localhost; dbname=alunos", "will", "will");
        }
        catch (PDOException $i)
        {
            //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return $con;
      }
    }


?>
