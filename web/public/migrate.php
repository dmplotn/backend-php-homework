<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/db/init.php';

use App\Mappers\UserMapper;
use App\Models\Users\User;
use App\Models\Role;


$mapper = new UserMapper($pdo);

$admin = new User(null, 'admin', password_hash('admin', PASSWORD_DEFAULT), new Role('admin'));

$mapper = new UserMapper($pdo);
$mapper->insert($admin);

for ($i = 1; $i <= 50; $i += 1) {
    $user = new User(null, "user{$i}", password_hash("pass{$i}", PASSWORD_DEFAULT), new Role('user'));
    $mapper->insert($user);
}
