<?php
include 'conexao.php';

// Consultas para produtos e sabores
$buscar_cadastrosSabor = "SELECT * FROM sabores"; 
$buscar_cadastrosProduto = "SELECT * FROM produtos"; 

// Executando as consultas
$query_cadastrosSabor = mysqli_query($connx, $buscar_cadastrosSabor);
if (!$query_cadastrosSabor) {
    die("Erro na consulta de sabores: " . mysqli_error($connx));
}

// Armazenar sabores em um array
$sabores = [];
while ($rowSabor = mysqli_fetch_assoc($query_cadastrosSabor)) {
    $sabores[] = $rowSabor; 
}

$query_cadastrosProduto = mysqli_query($connx, $buscar_cadastrosProduto);
if (!$query_cadastrosProduto) {
    die("Erro na consulta de produtos: " . mysqli_error($connx));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="modal.js" defer></script>
    <title>Controle de estoque</title>
</head>
<body>
<header>
  <img class="logo" src="logo/abssay.png" alt="Logo" />
</header>

<section class="botaos">
    <button class="btn-sabores">Criar sabores</button>
    <button class="btn-produto">Adicionar produto</button>
</section>

<dialog class="crudSabores esconde">
  <div class="crud-sabores">
      <div class="container-crud">
        <form class="form-sabores" action="cadastroSabor.php" method="POST">
             <h1>Adicionar Sabor</h1>
             <label for="nome-sabor">Nome do Sabor:</label>
              <input
                id="nome-sabor"
                name="nome-sabor"
                type="text"
                placeholder="Nome do sabor"
                required
              />
              <button type="submit">Adicionar</button>
              <button type="button" class="fechar-modal">Fechar</button> <!-- Botão de fechar -->
        </form>
      </div>
  </div>
</dialog>

<div id="message" class="hidden">Sabor cadastrado com sucesso!</div>
<div id="messageProduto" class="hidden">Produto cadastrado com sucesso!</div>

<!-- Modal para Adicionar Produto -->
<dialog class="crudProduto esconde">
    <div class="crud-produto">
        <div class="container-crud">
            <form class="form-produto" action="adicionarProduto.php" method="POST">
                <h1>Adicionar Produto</h1>
                <label for="produto-nome">Nome:</label>
                <input id="produto-nome" name="produto-nome" class="input-produto" type="text" required/>

                <label for="produto-valor">Valor:</label>
                <input id="produto-valor" name="produto-valor" class="input-produto" type="number" required/>

                <label for="produto-quantidade">Quantidade:</label>
                <input id="produto-quantidade" name="produto-quantidade" class="input-produto" type="number" required/>

                <label for="produto-sabores">Sabores:</label>
                <select name="listSabores" id="produto-sabores" required>
                    <?php
                    foreach ($sabores as $sabor) {
                        echo '<option value="' . $sabor['id'] . '">' . $sabor['nome'] . '</option>';
                    }
                    ?>
                </select>

                <button id="AddBtn-produto" type="submit">Cadastrar Produto</button>
                <button type="reset" class="fechar-modal">Fechar</button> <!-- Botão de fechar -->
            </form>
        </div>
    </div>
</dialog>

<section class="saboresCadastrados">
    <div class="divTable-sabor">
        <h1 class="tituloTbSabores">Sabores cadastrados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="tabelaTransacoes-sabores">
                <?php
                foreach ($sabores as $sabor) {
                    echo '<tr>';
                    echo '<td>' . $sabor['id'] . '</td>';
                    echo '<td>' . $sabor['nome'] . '</td>';
                    echo '<td>
                            <a class = "editar" href="editarSabor.php?id=' . $sabor['id'] . '">Editar</a>
                            <a class = "excluir" href="excluirSabor.php?id=' . $sabor['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este sabor?\');">Excluir</a>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<section class = "s-tabelaProduto">
    <div class="divTable-produto">
        <h1 class="tituloHistorico">Produtos cadastrados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>QTd</th>
                    <th>Sabores</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="tabelaTransacoes">
                <?php
                while ($rowProduto = mysqli_fetch_assoc($query_cadastrosProduto)) {
                    $saborId = $rowProduto['sabor_id'];
                    $querySabor = mysqli_query($connx, "SELECT nome FROM sabores WHERE id = $saborId");
                    $sabor = mysqli_fetch_assoc($querySabor);
                    echo '<tr>';
                    echo '<td>' . $rowProduto['id'] . '</td>';
                    echo '<td>' . $rowProduto['nome'] . '</td>';
                    echo '<td>' . $rowProduto['valor'] . '</td>';
                    echo '<td>' . $rowProduto['quantidade'] . '</td>';
                    echo '<td>' . ($sabor ? $sabor['nome'] : 'N/A') . '</td>';
                    echo '<td>
                            <a class = "editar" href="editarProduto.php?id=' . $rowProduto['id'] . '">Editar</a>
                            <a class = "excluir" href="excluirProduto.php?id=' . $rowProduto['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este produto?\');">Excluir</a>
                          </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
