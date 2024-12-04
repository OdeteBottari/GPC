<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Conexão com o banco de dados (substitua com suas credenciais)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checar conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verificar se o e-mail existe
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    
    // Usar prepared statement para segurança
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // E-mail encontrado, gerar token e enviar link de redefinição
        $token = bin2hex(random_bytes(50)); // Gera um token aleatório
        
        // Aqui você deve salvar o token no banco de dados associado ao usuário (opcional)
        // Exemplo:
        // $stmt = $conn->prepare("UPDATE usuarios SET reset_token=? WHERE email=?");
        // $stmt->bind_param("ss", $token, $email);
        // $stmt->execute();

        // Enviar e-mail com o link de redefinição
        $link = "http://seusite.com/redefinir_senha.php?token=$token"; // Ajuste a URL conforme necessário
        
        // Configurações do e-mail
        $assunto = "Redefinição de Senha";
        $mensagem = "Clique no link para redefinir sua senha: " . $link;

        if (mail($email, $assunto, $mensagem)) {
            echo "Um link de redefinição de senha foi enviado para seu e-mail.";
        } else {
            echo "Falha ao enviar o e-mail.";
        }
        
    } else {
        echo "E-mail não encontrado.";
    }

    // Fechar conexão
    $stmt->close();
    $conn->close();
}
?>