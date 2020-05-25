<?php

// index.php [session] => redirect (login.php, tasks.php)

include_once("functions.php");

if (!isset($_COOKIE["session"]) || !checksession($_COOKIE["session"])) {
    header("Location: login");
}
else {
	header("Location: tasks");
}