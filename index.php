<?php

$host = "localhost";
$user = "root";
$password = "root";
$database = "crud_aula";

$conexao = new mysqli ($host, $user, $password, $database);

if ($conexao->connect_error) {
    die ("erro na conexão: ". $conexao->connect_error); //tinha erro
}

// CADASTRAR

if (isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuarios (nome, email) VALUE (?, ?)";
    $stmt = $conexao->prepare($sql);

    $stmt->bind_param ("ss", $nome, $email);
    $stmt->execute();

    header("Location: index.php");
    exit;
}


//EXCLUIR 
if (isset($_GET['excluir'])){
    $id = $_GET['excluir'];

$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conexao->prepare($sql);

$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");
exit;
}

//EDITAR
if(isset($_POST['editar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);

    $stmt->bind_param("ssi", $nome, $email, $id);//tinha erro 
    $stmt->execute();

    header("Location: index.php");
    exit;
}

//BUSCAR USUÁRIOS
$sql = "SELECT id, nome, email FROM usuarios ORDER BY id DESC";
$resultado = $conexao->query($sql); //tinha erro

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>CRUD de Usuários</title>
</head>

<body>

    <h1>Cadastro de Usuários</h1>

    <form method="POST">

        <label>nome:</label>
        <input type="text" name ="nome" required>

        <br><br>

        <label>E-mail:</label>
        <input type="email" name ="email" required>

        <br><br>

        <button type="submit" name="cadastrar">
            cadastrar
        </button>

    </form>

    <h2>Usuários cadastrados</h2>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>

        <?php while ($usuario = $resultado->fetch_assoc()){ ?>

            <tr>

                <td>
                    <?= $usuario['id'] ?>
                </td>

                <td>
                    <?= htmlspecialchars($usuario['nome']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($usuario['email']) ?>
                </td>

                <td>
                    <a href="index.php?excluir=<?= $usuario ['id'] ?>">
                        excluir
                    </a>
                </td>

            </tr>
            
        <?php } ?> 
    
    </table>

</body>

</html>
        

        