<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar dados dos inscritos visíveis
$sql = "SELECT * FROM usuario WHERE visivel = 1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização da sua inscrição</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <h2>Visualização da sua inscrição</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sexo</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Nascimento</th>
            <th>Idade</th>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th>Ações</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["sexo"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["telefone"] . "</td>";
                echo "<td>" . $row["cpf"] . "</td>";
                echo "<td>" . $row["datanascimento"] . "</td>";
                echo "<td>" . $row["idade"] . "</td>";
                echo "<td>" . $row["categoria"] . "</td>";
                echo "<td>" . $row["SubCategoria"] . "</td>";
                echo "<td>
                        <a href='editar.php?id=" . $row["id"] . "'>Editar</a> |
                        <a href='excluir.php?id=" . $row["id"] . "' onclick='return confirm(\"Tem certeza que deseja excluir este inscrito?\")'>Excluir</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>Nenhum inscrito encontrado.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
