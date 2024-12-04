<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o ID foi passado na URL para buscar os dados do usuário
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do usuário com o ID especificado
    $sql = "SELECT * FROM usuario WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Se existir, carrega os dados do usuário
        $row = $result->fetch_assoc();
    } else {
        echo "Registro não encontrado!";
        exit();
    }
} else {
    echo "ID não fornecido!";
    exit();
}

// Atualiza o cadastro quando o formulário for enviado
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


    // Atualiza os dados no banco de dados
    $sql = "UPDATE usuario SET nome='$nome', sexo='$sexo', email='$email', telefone='$telefone', cpf='$cpf', datanascimento='$dataNascimento', idade='$idade', categoria='$categoria', SubCategoria='$SubCategoria', termo='$termos' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro atualizado com sucesso!";
        header("Location: adm_view.php");

    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Exemplo</title>
    <link rel="stylesheet" href="rostosite.css">
    
    <script>
    
    function calculateAge() {
    const birthDateInput = document.getElementById('datanascimento').value;
    const birthDate = new Date(birthDateInput);
    
    // Validar se a data é válida
    if (isNaN(birthDate.getTime())) {
        alert("Por favor, insira uma data válida.");
        return;
    }
    
    const today = new Date();
    
    // Verificar se a data de nascimento é no futuro
    if (birthDate > today) {
        alert("A data de nascimento não pode ser no futuro.");
        return;
    }

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();
    
    // Ajustar idade se o aniversário ainda não ocorreu este ano
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    document.getElementById('idade').value = age;
    setSubCategoria(age);
}

function setSubCategoria(age) {
    let subCategoria = '';
    
    if (age <= 11) subCategoria = 'Infantil';
    else if (age <= 14) subCategoria = 'Infanto Juvenil';
    else if (age <= 18) subCategoria = 'Juvenil';
    else if (age <= 30) subCategoria = 'Adulto 1';
    else if (age <= 40) subCategoria = 'Adulto 2';
    else if (age <= 50) subCategoria = 'Senior 1';
    else if (age <= 60) subCategoria = 'Senior 2';
    else if (age <= 70) subCategoria = 'Senior 3';
    else subCategoria = 'Master';
    
    document.getElementById('SubCategoria').value = subCategoria;
}
    
    </script>

    
    <style>
        table {
            width: fit-content;
            border-collapse: collapse;
            align-content:center;
        }
        th, td {
            /border: 1px solid black;/
            padding: 10px;
            width: 36%;
            
        }
        a {
            visibility: hidden;
        }
        h1{
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
        }

    </style>

</head>

<body>

<table>

    <form method="post" action="editar.php?id=<?php echo $id; ?>" id="editForm">
    <td><br><a>..............................</a></br></td>
    <td><br><a>................</a></br></td>
   
    <tr>
        <td colspan="8"><footer>
            <div class="container3">
            <h1> Usuário</h1>
            <button1>
                <i class="fas fa-thumbs-up"></i> <img src = './images.jpg';>
                <i class="fas fa-thumbs-up"></i> <img src = './images.png';>
              </button1>
            </div>
            </footer></td>
    </tr></br>
    
    <td colspan="5"><h1><a>...</a>Faça sua inscrição para Passeio Ciclístico - IFMT</h1></td>


    
    <tr><br>
        
        <td><div class="container6">
            <i class="fas fa-thumbs-up"></i> <img src = './download (1).jpg';><br><a>..</a></br>
        </div></td>

        
        <td colspan="2">
            
            <div class="container">
                <h2>CADASTRO</h2>
                <form id ="CADASTROForm">
                    <div class="form-group">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
                    </div>
        
                    
                    
                    <div class="form-group">
                        <label for="sexo">Sexo:</label><a>.............................................................</a>
                        <select id="sexo" name="sexo" <?php if ($row['sexo'] == ' ') echo 'selected'; ?> onkeyup="search(this)" required>
                            <option>----</option>
                            <option value="Femenino" <?php if ($row['sexo'] == 'Femenino') echo 'selected'; ?>>Femenino</option>
                            <option value="Masculino" <?php if ($row['sexo'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
                            <option value="Binario" <?php if ($row['sexo'] == 'Não binário') echo 'selected'; ?>>Binario</option>
                        </select>
                    </div>
        
                    <br/>
        
                    <div class="form-group">
                        <label for="email">E-mail: </label><a>.....................................</a>
                        <input type="email" id="email" name="email"  value="<?php echo $row['email']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone:</label><a>.....................................</a>
                        <input type="text" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" required placeholder="(65) 99999-9999">
        
        
                    <div class="form-group">
                        <label for="cpf">Cpf:</label><a>...........................................</a>
                        <input type="text" id="cpf" name="cpf" value="<?php echo $row['cpf']; ?>" required placeholder="000.000.000-00">
                    </div>
        
                    <div class="form-group">
                        <label for="datanascimento">Data de Nascimento:</label><a>.................................</a>
                        <input type="date" id="datanascimento" name="datanascimento" value="<?php echo $row['datanascimento']; ?>" onchange="calculateAge()" required>
                    </div>
        
                    <div class="form-group">
                        <label for="idade">Idade:</label><a>..............................</a>
                        <input type="text" id="idade" name="idade" value="<?php echo $row['idade']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Categoria</label><a>............................</a>
                        <select id="categoria" name="categoria" required>
                            <option value="Nehhum" <?php if ($row['categoria'] == 'Nenhum') echo 'selected'; ?>>Nenhum</option>
                            <option value="Aluno IFMT" <?php if ($row['categoria'] == 'Aluno IFMT') echo 'selected'; ?>>ALUNO IFMT</option>
                            <option value="Professor IFMT" <?php if ($row['categoria'] == 'Professor IFMT') echo 'selected'; ?>>PROFESSOR IFMT</option>
                            <option value="Servidor IFMT" <?php if ($row['categoria'] == 'Servidor IFMT') echo 'selected'; ?>>Servidor IFMT</option>
                            <option value="Comunidade Geral" <?php if ($row['categoria'] == 'Comunidade Geral') echo 'selected'; ?>>Comunidade Geral</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="SubCategoria">SubCategoria</label><a>............................</a>
                        <input type="text" id="SubCategoria" name="SubCategoria" onchange="setSubCategoria()" value="<?php echo $row['SubCategoria']; ?>" required>
                            
                    </div>
        
                    <br/>
                    
                    
                    <div class="form-group">
                        <label> Leu as regras e aceita os termos para participar do evento?<a>..............................</a> </label>
                        <label><input type="radio" id="aceito" name="termo" value="1" <?php if ($row['termo'] == 1) echo 'checked'; ?> required>Sim</label>
                        <label><input type="radio" id="naoaceito" name="termo" value="0" <?php if ($row['termo'] == 0) echo 'checked'; ?>>Não</label>



                    </div>
        
                    <br/>
                    
                    <button type="submit" class="btn">Atualizar </button>
        
                </form>
            </div>
        
            <form>
                <div class="container5">
                    <button2>
                        <i class="fas fa-thumbs-up"></i> <img src = './images (1).jpg';>
                    </button2>
                        </div>
            </form>
        </body>
        </html></td></br>

        <td><div class="container7">
            <i class="fas fa-thumbs-up"></i> <img src = './download.jpg';>
        </div></td>
        
    </tr>
    <tr>
       
        <td><br><a>................</a></br></td>
    </tr>
    
</form>

</table>
<br><a>.................................</a><br>
</body>
</html>