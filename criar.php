<!DOCTYPE html>
<html>
  
<head>
    <title>Criar Produto</title>
</head>
<body>
  <link rel="stylesheet" href="style.css">
    <main>
      <header>Criar Produto</header>
          <form action="criar.php" method="post">
          <input type="text" name="nome" id="nome" placeholder="Nome">
          <input type="text" name="preco" id="preco" placeholder="Preço">
          <input type="text" name="descricao" id="descricao" placeholder="Descrição">
          <input type="submit" value="Criar">
    </main>
            
    <nav>  
      <h2>  
        <a href="listar.php">Listar Produtos</a>
        <a href="editar.php">Editar Produtos</a>
        <a href="excluir.php">Excluir Produtos</a>
      </h2>
    </nav>  
      
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

        $query = "INSERT INTO produtos (id, nome, preco, descricao) VALUES (:id, :nome, :preco, :descricao)";
        $stmt = $db->prepare($query);

        if ($stmt) {
            $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
            $stmt->bindValue(':preco', $preco, SQLITE3_INTEGER);
            $stmt->bindValue(':descricao', $descricao, SQLITE3_TEXT);

            if ($stmt->execute()) {
                echo "Produto criado com sucesso!";
            } else {
                echo "Erro ao criar o produto: " . $db->lastErrorMsg();
            }
            } else {
            echo "Erro ao preparar a consulta SQL: " . $db->lastErrorMsg();
        }
        $db->close();
    }
    ?>
</body>
</html>
