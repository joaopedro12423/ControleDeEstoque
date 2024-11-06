<?php
include 'conexao.php';

// Verifica se o ID do sabor foi passado
if (!isset($_GET['id'])) {
    die("ID do sabor não fornecido.");
}

// Recupera o ID do sabor
$saborId = $_GET['id'];

// Consulta o sabor específico
$querySabor = mysqli_query($connx, "SELECT * FROM sabores WHERE id = $saborId");
$sabor = mysqli_fetch_assoc($querySabor);

if (!$sabor) {
    die("Sabor não encontrado.");
}

// Processa a edição do sabor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeSabor = $_POST['nome-sabor'];

    // Atualiza o sabor no banco de dados
    $updateQuery = "UPDATE sabores SET nome = '$nomeSabor' WHERE id = $saborId";
    if (mysqli_query($connx, $updateQuery)) {
        header("Location: listaSabor.php?message=Sabor atualizado com sucesso!");
        exit();
    } else {
        die("Erro ao atualizar sabor: " . mysqli_error($connx));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleeditarsabor.css" />
    <title>Editar Sabor</title>
</head>
<body>
    <div class="container">
        <h1>Editar Sabor</h1>
    <form action="" method="POST">
        <label for="nome-sabor">Nome do Sabor:</label>
        <input id="nome-sabor" name="nome-sabor" type="text" value="<?php echo $sabor['nome']; ?>" required />
        <button type="submit">Atualizar</button>
    </form>
    <a href="listaSabor.php">Voltar</a></div>
</body>
</html>
