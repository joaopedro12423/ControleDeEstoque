<?php
include 'conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os valores dos campos do formulário
    $produto_nome = mysqli_real_escape_string($connx, $_POST['produto-nome'] ?? null);
    $produto_valor = mysqli_real_escape_string($connx, $_POST['produto-valor'] ?? null);
    $produto_quantidade = mysqli_real_escape_string($connx, $_POST['produto-quantidade'] ?? null);
    $sabor_id = mysqli_real_escape_string($connx, $_POST['listSabores'] ?? null);

    // Verifica se todos os campos estão preenchidos
    if (!empty($produto_nome) && !empty($produto_valor) && !empty($produto_quantidade) && !empty($sabor_id)) {
        // Insere o novo produto no banco de dados
        $sql = "INSERT INTO produtos (nome, valor, quantidade, sabor_id) VALUES ('$produto_nome', '$produto_valor', '$produto_quantidade', '$sabor_id')";
        
        if (mysqli_query($connx, $sql)) {
            // Redireciona de volta para a página do CRUD de produtos com mensagem de sucesso
            header('Location: listaSabor.php?mensagem=sucesso');
            exit;
        } else {
            echo "Erro ao inserir produto: " . mysqli_error($connx); // Mensagem de erro detalhada
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
