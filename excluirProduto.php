<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
    die("ID do produto não fornecido.");
}

$produtoId = $_GET['id'];
$deleteQuery = "DELETE FROM produtos WHERE id = $produtoId";

if (mysqli_query($connx, $deleteQuery)) {
    header("Location: listaSabor.php?message=Produto excluído com sucesso!");
    exit();
} else {
    die("Erro ao excluir produto: " . mysqli_error($connx));
}
?>
