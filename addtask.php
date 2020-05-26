<?php

// addtask.php

include_once("functions.php");

if (!isset($_COOKIE["session"]) || !isset($_COOKIE["login"]) || !checksession($_COOKIE["login"], $_COOKIE["session"])) {
    header("Location: login");
}
else if ($_COOKIE["login"] != "admin") {
    header("Location: index");
}
else {
    if (!isset($_POST["name"]) || !isset($_POST["description"]) || !isset($_POST["picture"])) {
        echo "Not found all args";
    }
    $res = addtask($_POST["name"], $_POST["description"], $_POST["picture"]);
    if (!$res[0]) {
        echo "Error: " . $res[1];
    }
    else {
        header("Location: tasks");
    }
}