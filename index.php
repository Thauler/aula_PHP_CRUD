<?php
require 'config.php';
require 'dao/UserDAOMysql.php';

$userDao = new UserDAOMysql($pdo);
$listAll = $userDao->findAll();

?>
<a href="create.php">CREATE USER</a>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>ACTIONS</th>
    </tr>
    <?php foreach ($listAll as $user): ?>
        <tr>
            <td><?= $user->getId(); ?></td>
            <td><?= $user->getName(); ?></td>
            <td><?= $user->getEmail(); ?></td>
            <td>
<!--                <a href="update.php?id=--><?//= $user['id']; ?><!--">[ Edit ]</a>-->
<!--                <a-->
<!--                        href="delete.php?id=--><?//= $user['id']; ?><!--"-->
<!--                        onclick="return confirm('Are you sure?')">-->
<!--                    [ Remove ]-->
<!--                </a>-->
            </td>
        </tr>
    <?php endforeach; ?>
</table>