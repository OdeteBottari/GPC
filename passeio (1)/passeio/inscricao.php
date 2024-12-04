<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['datanascimento'];
    $idade = $_POST['idade'];
    $categoria = $_POST['categoria'];
    $SubCategoria = $_POST['SubCategoria'];
    $termos = isset($_POST['termo']) ? 1 : 0;
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuario (nome, sexo, email, telefone, cpf, datanascimento, idade, categoria, SubCategoria, termo, visivel, senha)
    VALUES ('$nome', '$sexo', '$email', '$telefone', '$cpf', '$dataNascimento', '$idade', '$categoria', '$SubCategoria', '$termos', '$senha', TRUE)";

    if ($conn->query($sql) === TRUE) {
        echo "Inscrição realizada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>