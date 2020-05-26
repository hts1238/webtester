<?php

// task.php

include_once("functions.php");

if(!isset($_COOKIE["session"]) || !isset($_COOKIE["login"]) || !checksession($_COOKIE["login"], $_COOKIE["session"])) {
    header("Location: login");
}
else if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $login = $_COOKIE["login"];
    $res = gettask($id);

    if (!$res[0]) {
        echo "Error: " . $res[1];
    }
    else {
        if ($login == "admin") {
            $resa = getsolution($id);
            if (!$resa[0]) {
                echo "Error: " . $res[1];
            }
            else {
                $resa = $resa[1];
            }
        }
        include_once("templates/task.html");
    }
}