<!DOCTYPE html>
<html>
  
<head>
    <title>Lista de Produtos</title>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="style.css">
    <main>
      <header>Lista de Produtos</header>
        <table>
          <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Descricao</th>
              <th>Preco</th>
          </tr>
    </main>   
            
      <nav>
        <a href="criar.php">Criar Produtos</a>
        <a href="editar.php">Editar Produtos</a>
        <a href="excluir.php">Excluir Produtos</a>
      </nav>
         
      
        <?php
        $db = new SQLite3('database.db');

        if (!$db) {
            die("Erro na conexão com o banco de dados.");
        }
        $query = "SELECT * FROM Produtos";
        $result = $db->query($query);
        if (!$result) {
            die("Erro na consulta SQL: " . $db->lastErrorMsg());
        }
        while ($row = $result->fetchArray()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>"; 
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>" . $row['preco'] . "</td>";
            echo "</tr>";
        }
        $db->close();
        ?>
    </table>
    
</body>
</html>
