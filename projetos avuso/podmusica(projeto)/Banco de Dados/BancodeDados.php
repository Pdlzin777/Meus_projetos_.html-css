<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Preparar e bind
$stmt = $conn->prepare("INSERT INTO usuarios (login, senha) VALUES (?, ?)");
$stmt->bind_param("ss", $login, $senha);

// Definir parâmetros e executar
$login = $_POST['username'];
$senha = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da senha
$stmt->execute();

// Fechar a conexão
$stmt->close();
$conn->close();

// Redirecionar para a página de sucesso
header("Location: ..//index.html");
exit();
?>





<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Preparar e executar a consulta
$stmt = $conn->prepare("SELECT senha FROM usuarios WHERE login = ?");
$stmt->bind_param("s", $login);

// Definir parâmetros e executar
$login = $_POST['username'];
$stmt->execute();
$stmt->store_result();

// Verificar se o usuário existe
if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verificar a senha
    if (password_verify($_POST['password'], $hashed_password)) {
        // Senha correta, redirecionar para a página de sucesso
        header("Location: ..//index.html");
        exit();
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
