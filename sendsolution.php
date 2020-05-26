<?php

// task.php

include_once("functions.php");

if(!isset($_COOKIE["session"]) || !isset($_COOKIE["login"]) || !checksession($_COOKIE["login"], $_COOKIE["session"])) {
    header("Location: login");
}
else if (!isset($_POST["html"]) || !isset($_POST["css"]) || !isset($_POST["task_id"])) {
    echo "Not found all args";
}
else {
    $login = $_COOKIE["login"];
    $id = $_POST["task_id"];
    $html = $_POST["html"];
    $css = $_POST["css"];
    $res = sendsolution($login, $id, $html, $css);

    if (!$res[0]) {
        echo "Error: " . $res[1];
    }
    else {
        header("Location: task?id=$id");
    }
}