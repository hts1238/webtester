<?php

// task.php

include_once("functions.php");

if(!isset($_COOKIE["session"]) || !isset($_COOKIE["login"]) || !checksession($_COOKIE["login"], $_COOKIE["session"])) {
    header("Location: login");
}
else if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $res = gettask($id);

    if (!$res[0]) {
        echo "Error: " . $res[1];
    }
    else {
        include_once("templates/task.html");
    }
}