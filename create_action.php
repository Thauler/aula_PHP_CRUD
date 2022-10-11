<?php
require 'config.php';
require 'dao/UserDAOMysql.php';

$userDao = new UserDAOMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


$setNewUser = function (string $name, string $email) use ($userDao): void {
    $user = new User();
    $user->setName($name);
    $user->setEmail($email);

    $userDao->create($user);
};

$emailChecker = $userDao->findByEmail($email) ?: $setNewUser($name, $email);

if ($name && $email) {

    if (!$emailChecker) {
        header("Location: index.php");
        exit;

    }
    header("Location: create.php");
    exit;

}
