<?php

// login.php {error | null | type=new name login first_password second_password | type=login login password} => redirect (login.php {error}, tasks.php) or show error

include_once("functions.php");
include_once("templates/header.html");


if (isset($_COOKIE["session"]) && isset($_COOKIE["login"]) && checksession($_COOKIE["login"], $_COOKIE["session"])) {
    header("Location: index");
    exit();
}
else if (($_POST["type"] ?? "") == "new") {
    $name = $_POST["name"];
    $login = $_POST["login"];
    $first_password = $_POST["first_password"];
    $second_password = $_POST["second_password"];

    if ($first_password != $second_password) {
        header("Location: login?error=Different passwords");
        exit();
    }
    else {
        $password = $first_password;

        $res = signup($name, $login, $password);

        if (!$res) {
            header("Location: login?error=error");
            exit();
        }
        else {
            header("Location: index");
            exit();
        }
    }
}
else if (($_POST["type"] ?? "") == "login") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $res = login($login, $password);
    if (!$res[0]) {
        header("Location: login?error=".$res[1]);
        exit();
    }
    else {
        setcookie("login", $login, time() + 31536000, "./");
        setcookie("session", $res[1], time() + 31536000, "./");
    
        header("Location: index");
        exit();
    }
}
else {
    $error = $_GET["error"] ?? "";
    include_once("templates/login.html");
}

include_once("templates/footer.html");