<?php
require 'config.php';
require 'dao/UserDAOMysql.php';

$userDao = new UserDAOMysql($pdo);

$user = false;
$id = filter_input(INPUT_GET, 'id');

if ($id) {
    $user = $userDao->findById($id);
}

if (!$user) {
    header("Location: index.php");
    exit;
}
?>
<h1>Update User</h1>

<form method="POST" action="update_action.php">
    <input type="hidden" name="id" value="<?=$user->getId();?>" />

    <label>
        Name:<br/>
        <input type="text" name="name" value="<?= $user->getName(); ?>"/>
    </label><br/><br/>

    <label>
        E-mail:<br/>
        <input type="email" name="email" value="<?= $user->getEmail(); ?>"/>
    </label><br/><br/>

    <input type="submit" value="Update"/>
</form>