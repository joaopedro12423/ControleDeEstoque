<?php
include 'conexao.php';

// Verifica se o ID do sabor foi passado
if (!isset($_GET['id'])) {
    die("ID do sabor não fornecido.");
}

// Recupera o ID do sabor
$saborId = $_GET['id'];

// Exclui produtos que referenciam o sabor
$deleteProdutosQuery = "DELETE FROM produtos WHERE sabor_id = $saborId";
mysqli_query($connx, $deleteProdutosQuery);

// Exclui o sabor no banco de dados
$deleteQuery = "DELETE FROM sabores WHERE id = $saborId";
if (mysqli_query($connx, $deleteQuery)) {
    header("Location: listaSabor.php?message=Sabor excluído com sucesso!");
    exit();
} else {
    die("Erro ao excluir sabor: " . mysqli_error($connx));
}
?>
