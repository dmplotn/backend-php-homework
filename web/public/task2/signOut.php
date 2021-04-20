<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/task2/AuthManager.php';

use function Task2\AuthManager\signOut;

session_start();

signOut();

header('Location: /task2/signInPage.php');
