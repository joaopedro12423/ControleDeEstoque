<?php 
  $host = 'localhost';
  $user = 'root';
  $passwd = 'laranja';
  $bd_name = 'Gerenciador_estoque';

  // Conexao com o banco de dados
  $connx = mysqli_connect($host, $user, $passwd, $bd_name);

  // Verifica se a conexão foi bem-sucedida
  // if ($connx) {
  //   echo 'Conectou com sucesso!';
  // } else {
  //   echo 'Erro ao conectar com o banco de dados: ' . mysqli_connect_error();
  // }
?>
