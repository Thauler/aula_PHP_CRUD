<?php
require 'config.php';

$lista = [];
$sql = $pdo->query("SELECT * FROM test.usuarios");
if ($sql->rowCount() > 0) {
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<a href="adicionar.php">ADICIONAR USUÁRIO</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>AÇÕES</th>
    </tr>
    <?php foreach ($lista as $usuario): ?>
        <tr>
            <td><?= $usuario['id']; ?></td>
            <td><?= $usuario['name']; ?></td>
            <td><?= $usuario['email']; ?></td>
            <td>
                <a href="editar.php?id=<?= $usuario['id']; ?>">[ Editar ]</a>
                <a
                        href="delete.php?id=<?= $usuario['id']; ?>"
                        onclick="return confirm('Tem certeza que quer excluir o usuario')">
                    [ Excluir ]
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>