<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega o valor do campo de nome do sabor
    $nome_sabor = mysqli_real_escape_string($connx, $_POST['nome-sabor']);

    // Verifica se o campo de nome está preenchido
    if (!empty($nome_sabor)) {
        // Insere o novo sabor no banco de dados
        $sql = "INSERT INTO sabores (nome) VALUES ('$nome_sabor')";
        
        if (mysqli_query($connx, $sql)) {
            // Redireciona de volta para a página do CRUD de sabores com mensagem de sucesso
            header('Location: listaSabor.php?mensagem=sucesso');
            exit;
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($connx);
        }
    } else {
        echo "Por favor, preencha o campo de nome do sabor.";
    }
}
?>
