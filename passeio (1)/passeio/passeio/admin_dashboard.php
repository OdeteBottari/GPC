<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.html");
    exit();
}

// Conexão ao banco de dados e consulta aos participantes visíveis
$servername = "localhost";
$username = "root"; // seu usuário do banco de dados
$password = ""; // sua senha do banco de dados
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM participantes WHERE visivel=1 ORDER BY nome_completo ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Painel Administrativo</title>
</head>
<body>
    <h1>Painel Administrativo</h1>
    <table>
        <tr>
            <th>Nome Completo</th>
            <th>Categoria</th>
            <th>Subcategoria</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['nome_completo']; ?></td>
                <td><?php echo $row['categoria']; ?></td>
                <td><?php echo $row['subcategoria']; ?></td>
                <td>
                    <a href="view_participant.php?id=<?php echo $row['id']; ?>">Visualizar</a> |
                    <a href="delete_participant.php?id=<?php echo $row['id']; ?>">Excluir</a> |
                    <a href="edit_participant.php?id=<?php echo $row['id']; ?>">Alterar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="logout.php">Sair</a>

</body>
</html>

<?php 
$conn->close();
?>
