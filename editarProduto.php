<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
    die("ID do produto não fornecido.");
}

$produtoId = $_GET['id'];
$queryProduto = mysqli_query($connx, "SELECT * FROM produtos WHERE id = $produtoId");
$produto = mysqli_fetch_assoc($queryProduto);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['produto-nome'];
    $valor = $_POST['produto-valor'];
    $quantidade = $_POST['produto-quantidade'];
    $sabor_id = $_POST['listSabores'];

    $updateQuery = "UPDATE produtos SET nome = '$nome', valor = '$valor', quantidade = '$quantidade', sabor_id = '$sabor_id' WHERE id = $produtoId";
    
    if (mysqli_query($connx, $updateQuery)) {
        header("Location: listaSabor.php?message=Produto atualizado com sucesso!");
        exit();
    } else {
        die("Erro ao atualizar produto: " . mysqli_error($connx));
    }
}

$saboresQuery = mysqli_query($connx, "SELECT * FROM sabores");
$sabores = [];
while ($rowSabor = mysqli_fetch_assoc($saboresQuery)) {
    $sabores[] = $rowSabor;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styleeditarproduto.css" />
    <title>Editar Produto</title>
</head>
<body>
<div class="container">
    <h1>Editar Produto</h1>
    <form action="" method="POST">
        <label for="produto-nome">Nome:</label>
        <input id="produto-nome" name="produto-nome" type="text" value="<?php echo $produto['nome']; ?>" required/>

        <label for="produto-valor">Valor:</label>
        <input id="produto-valor" name="produto-valor" type="number" value="<?php echo $produto['valor']; ?>" required/>

        <label for="produto-quantidade">Quantidade:</label>
        <input id="produto-quantidade" name="produto-quantidade" type="number" value="<?php echo $produto['quantidade']; ?>" required/>

        <label for="produto-sabores">Sabores:</label>
        <select name="listSabores" id="produto-sabores" required>
            <?php
            foreach ($sabores as $sabor) {
                $selected = ($sabor['id'] == $produto['sabor_id']) ? 'selected' : '';
                echo '<option value="' . $sabor['id'] . '" ' . $selected . '>' . $sabor['nome'] . '</option>';
            }
            ?>
        </select>

        <button type="submit">Atualizar Produto</button>
    </form>
</div>
</body>
</html>
