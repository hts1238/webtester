<?php

// index.php [session] => redirect (login.php, tasks.php)

include_once("functions.php");

if (!isset($_COOKIE["session"]) || !isset($_COOKIE["login"]) || !checksession($_COOKIE["login"], $_COOKIE["session"])) {
    header("Location: login");
}
else {
	header("Location: tasks");
}