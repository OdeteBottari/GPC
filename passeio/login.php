<?php
session_start();

$servername = "localhost";
$username = "root"; // seu usuário do banco de dados
$password = ""; // sua senha do banco de dados
$dbname = "test";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Sanitizar entrada
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Obter e sanitizar dados do formulário
$nome = sanitizeInput($_POST['nome']);
$senha_input = sanitizeInput($_POST['senha']);

// Consultar administrador no banco de dados
$sql = "SELECT * FROM administradores WHERE nome='$nome'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verificar a senha
    if (password_verify($senha_input, $row['senha'])) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php"); // Redirecionar para o painel administrativo
        exit();
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Administrador não encontrado.";
}

$conn->close();
?>
