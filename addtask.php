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
    if (!isset($_POST["name"]) || !isset($_POST["description"]) || !isset($_FILES["picture"])) {
        echo "Not found all args";
        exit();
    }

    $uploaddir = 'pictures/';
    $uploadfile = $uploaddir . basename($_FILES['picture']['name']);
    $mv_res = move_uploaded_file($_FILES['picture']['tmp_name'], $uploadfile);

    if (!$mv_res) {
        echo "Error! " . $_FILES['picture']['error'];
        print_r($_FILES);
        exit();
    }


    $res = addtask($_POST["name"], $_POST["description"], $uploadfile);
    if (!$res[0]) {
        echo "Error: " . $res[1];
        exit();
    }

    header("Location: tasks");
    
}