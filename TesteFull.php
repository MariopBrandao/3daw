<?php
$alunos = [];

function incluir_aluno($nome, $matricula, $curso) {
    global $alunos;
    $alunos[] = ["nome" => $nome, "matricula" => $matricula, "curso" => $curso];
}

function alterar_aluno($matricula, $novo_nome, $novo_curso) {
    global $alunos;
    foreach ($alunos as &$aluno) {
        if ($aluno["matricula"] == $matricula) {
            $aluno["nome"] = $novo_nome;
            $aluno["curso"] = $novo_curso;
            break;
        }
    }
}

function excluir_aluno($matricula) {
    global $alunos;
    foreach ($alunos as $key => $aluno) {
        if ($aluno["matricula"] == $matricula) {
            unset($alunos[$key]);
            break;
        }
    }
    $alunos = array_values($alunos);
}

function listar_alunos() {
    global $alunos;
    return $alunos;
}

function buscar_aluno($matricula) {
    global $alunos;
    foreach ($alunos as $aluno) {
        if ($aluno["matricula"] == $matricula) {
            return $aluno;
        }
    }
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["incluir"])) {
        incluir_aluno($_POST["nome"], $_POST["matricula"], $_POST["curso"]);
    } elseif (isset($_POST["alterar"])) {
        alterar_aluno($_POST["matricula"], $_POST["nome"], $_POST["curso"]);
    } elseif (isset($_POST["excluir"])) {
        excluir_aluno($_POST["matricula"]);
    }
}

$aluno = null;
if (isset($_GET["matricula"])) {
    $aluno = buscar_aluno($_GET["matricula"]);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Alunos</title>
</head>
<body>
    <h1>CRUD de Alunos</h1>

    <h2>Incluir Aluno</h2>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Matrícula:</label>
        <input type="text" name="matricula" required>
        <label>Curso:</label>
        <input type="text" name="curso" required>
        <input type="submit" name="incluir" value="Incluir">
    </form>

    <h2>Alterar Aluno</h2>
    <form method="post">
        <label>Matrícula:</label>
        <input type="text" name="matricula" required>
        <label>Novo Nome:</label>
        <input type="text" name="nome" required>
        <label>Novo Curso:</label>
        <input type="text" name="curso" required>
        <input type="submit" name="alterar" value="Alterar">
    </form>

    <h2>Listar Alunos</h2>
    <?php if (count($alunos) > 0): ?>
        <table>
            <tr>
                <th>Nome</th

            </tr>
            <?php foreach ($alunos as $aluno): ?>
            <tr>
                <td><?php echo $aluno["nome"]; ?></td>
                <td><?php echo $aluno["matricula"]; ?></td>
                <td><?php echo $aluno["curso"]; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum aluno encontrado.</p>
    <?php endif; ?>

    <h2>Listar um Aluno</h2>
    <form method="get">
        <label>Matrícula:</label>
        <input type="text" name="matricula" required>
        <input type="submit" value="Buscar">
    </form>

    <?php if ($aluno): ?>
        <h3>Informações do Aluno:</h3>
        <p>Nome: <?php echo $aluno["nome"]; ?></p>
        <p>Matrícula: <?php echo $aluno["matricula"]; ?></p>
        <p>Curso: <?php echo $aluno["curso"]; ?></p>
        <form method="post">
            <input type="hidden" name="matricula" value="<?php echo $aluno["matricula"]; ?>">
            <input type="submit" name="excluir" value="Excluir">
        </form>
    <?php elseif (isset($_GET["matricula"])): ?>
        <p>Aluno não encontrado.</p>
    <?php endif; ?>

</body>
</html>
