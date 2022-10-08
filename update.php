<?php
require 'config.php';

$info = array();
$id = filter_input(INPUT_GET, 'id');

if ($id) {

    $sql = $pdo->prepare("SELECT * FROM test.users WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {

        $info = $sql->fetch(PDO::FETCH_ASSOC);

    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>
<h1>Update User</h1>

<form method="POST" action="update_action.php">
    <input type="hidden" name="id" value="<?=$info['id'];?>" />

    <label>
        Nome:<br/>
        <input type="text" name="name" value="<?= $info['name']; ?>"/>
    </label><br/><br/>

    <label>
        E-mail:<br/>
        <input type="email" name="email" value="<?= $info['email']; ?>"/>
    </label><br/><br/>

    <input type="submit" value="Update"/>
</form>