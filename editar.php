<!DOCTYPE html>
<html>
  
<head>
    <title>Editar Produto</title>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="style.css">
  <main>
    <header>Editar Produtos</header>
      <form action="editar.php" method="post">
        <input type="text" name="id" id="id" placeholder="ID">
        <input type="text" name="nome" id="nome" placeholder="Nome">
        <input type="text" name="preco" id="preco" placeholder="Preco">
        <input type="text" name="descricao" id="descricao" placeholder="Descricao">
        <input type="submit" value="editar">
      </form>
  </main>
  <nav>  
    <h2>  
      <a href="listar.php">Listar Produtos</a>
      <a href="criar.php">Criar Produtos</a>
      <a href="excluir.php">Excluir Produtos</a>
    </h2>
  </nav>  
</body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = new SQLite3('database.db');
        if (!$db) {
            die("Erro ao conectar ao banco de dados.");
        }

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];

        $query = "UPDATE produtos SET nome = :nome, preco = :preco, descricao = :descricao WHERE id = :id";

        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
            $stmt->bindValue(':preco', $preco, SQLITE3_INTEGER);
            $stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);

            if ($stmt->execute()) {
                echo "Produto editado com sucesso!";
            } else {
                echo "Erro ao editar o produto: " . $db->lastErrorMsg();
            }
        } else {
            echo "Erro ao preparar a consulta SQL: " . $db->lastErrorMsg();
        }
        $db->close();
    }
    ?>
