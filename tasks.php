<?php

// tasks.php [session] => list of tasks (they redirect to task.php {id, [type]}

include_once("functions.php");

if (!isset($_COOKIE["session"]) || !isset($_COOKIE["login"]) || !checksession($_COOKIE["login"], $_COOKIE["session"])) {
    header("Location: login");
}
else {
    $login = $_COOKIE["login"];
    $tasks = getlistoftasks();
    if ($tasks[0]) {
        $list = $tasks[1];
        $error = "";
    }
    else {
        $list = [];
        $error = $tasks[1];
    }
    include_once("templates/tasks.html");
}