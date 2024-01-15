<!DOCTYPE html>
<html>

<head>
    <title>Excluir Produto</title>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="style.css">
  <main >
    <header>Excluir Produtos</header>
      <form action="excluir.php" method="post">
        <input type="text" name="id" id="id" placeholder="ID">
        <input type="submit" value="excluir">
      </form>
  </main>
  <nav>  
    <h2>  
      <a href="listar.php">Listar Produtos</a>
      <a href="editar.php">Editar Produtos</a>
      <a href="criar.php">Criar Produtos</a>
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

        $query = "DELETE FROM produtos WHERE id = :id";
        
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
            
            if ($stmt->execute()) {
                echo "Produto excluido com sucesso!";
            } else {
                echo "Erro ao excluir o produto: " . $db->lastErrorMsg();
            }
            } else {
            echo "Erro ao preparar a consulta SQL: " . $db->lastErrorMsg();
        }
        $db->close();
    }
    ?>
