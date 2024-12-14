<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Aqui você pode salvar os dados em um banco de dados ou processá-los conforme necessário.
    
    // Exemplo de resposta:
    echo "<h1>Avaliação Recebida!</h1>";
    echo "<p>nome: $nome</p>";
    echo "<p>Nota: $rating</p>";
    echo "<p>Comentário: $comment</p>";
} else {
    echo "Método de requisição inválido.";
}
?>