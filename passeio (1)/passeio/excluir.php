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

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Converte o ID para um inteiro

    // Atualiza o campo 'visivel' para 0
    $sql = "UPDATE usuario SET visivel = 0 WHERE id = ?";
    
    // Prepara e executa a declaração
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Inscrito excluído com sucesso.";
        } else {
            echo "Erro ao excluir inscrito: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }
} else {
    echo "ID não fornecido.";
}

$conn->close();

// Redireciona de volta para a página de visualização
header("Location: adm_view.php");
exit();
?>