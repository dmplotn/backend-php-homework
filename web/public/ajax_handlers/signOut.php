<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../bootstrap/autoload/init.php';

use App\Auth;

session_start();

Auth::signOut();
