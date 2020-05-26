<?php

function connect() {
    $DB_HOST = "localhost";
    $DB_LOGIN = "h56372_dbuser";
    $DB_PASSWORD = "011470.ru";
    $DB_NAME = "h56372_db";

    $db = mysqli_connect(
        $DB_HOST,
        $DB_LOGIN,
        $DB_PASSWORD,
        $DB_NAME
    );

    mysqli_set_charset($db, 'utf8');
    return $db;
}

function showerrors() {
    //echo $errors;
    return "";
}

function checksession(&$login, &$session) {
    $db = connect();

    $sql = "SELECT login FROM webtester_connects WHERE session='$session'";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return false; // mysqli_error($db);
    }

    $result = mysqli_fetch_assoc($sql_result);

    if ($result["login"] != $login) {
        return false;
    }

    return true;
}

function gettoken() {
    $size = 25;
    $symbols = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
    ];
    $length = count($symbols);
    $token = '';
    for ($i = 0; $i < $size; $i++) {
        $token .= $symbols[rand(0, $length - 1)];
    }
    return $token;
}

function login(&$login, &$password) {
    $db = connect();

    $sql = "SELECT password FROM webtester_users WHERE login='$login'";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    $result = mysqli_fetch_assoc($sql_result);

    if ($result["password"] != $password) {
        return [false, "Incorrect password"];
    }

    $token = gettoken();
    $time = time();

    $sql = "INSERT INTO webtester_connects(login, time, session) VALUES ('$login', '$time', '$token')";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    return [true, $token];
}

function signup(&$name, &$login, &$password) {
    $db = connect();

    $sql = "INSERT INTO webtester_users(name, login, password) VALUES ('$name', '$login', '$password')";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return false; // mysqli_error($db);
    }

    return true;
}

function getlistoftasks() {
    $db = connect();

    $sql = "SELECT id, name, picture FROM webtester_tasks";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    $result = mysqli_fetch_all($sql_result);

    $res = [];
    for ($i = 0; $i < count($result); $i++) {
        $id = $result[$i][0];
        $name = $result[$i][1];
        $pict = $result[$i][2];
        $res[$id] = [
            "name" => $name,
            "picture" => $pict,
        ];
    }

    return [true, $res];
}

function gettask(&$id) {
    $db = connect();

    $sql = "SELECT name, description, picture FROM webtester_tasks WHERE id='$id'";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    $result = mysqli_fetch_assoc($sql_result);

    if (!isset($result)) {
        return [false, "Task does not exist"];
    }

    return [true, $result];
}

function addtask(&$name, &$description, &$picture) {
    $db = connect();

    $sql = "INSERT INTO webtester_tasks(name, description, picture) VALUES ('$name', '$description', '$picture')";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    return [true, ""];
}

function sendsolution(&$login, &$id, &$html, &$css) {
    $db = connect();

    $sql = "INSERT INTO webtester_solutions(task_id, login, html, css, status) VALUES ($id, '$login', '$html', '$css', 0)";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    return [true, ""];
}

function getsolution(&$task_id) {
    $db = connect();

    $sql = "SELECT id, login, html, css, status FROM webtester_solutions WHERE task_id='$task_id'";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    $result = mysqli_fetch_all($sql_result);

    $res = [];
    for ($i = 0; $i < count($result); $i++) {
        $id = $result[$i][0];
        $login = $result[$i][1];
        $html = $result[$i][2];
        $css = $result[$i][3];
        $status = $result[$i][4];
        $res[$id] = [
            "login" => $login,
            "html" => $html,
            "css" => $css,
            "status" => $status,
        ];
    }

    return [true, $res];
}

function changestatus(&$id, &$code) {
    $db = connect();

    $sql = "UPDATE webtester_solutions SET status=$code WHERE id=$id";
    $sql_result = mysqli_query($db, $sql);

    if (!$sql_result) {
        return [false, mysqli_error($db)];
    }

    return [true, $sql];
}
