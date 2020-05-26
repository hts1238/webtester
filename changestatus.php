<?php

// changestatus.php

header('Content-Type: application/json');

include_once("functions.php");

if(!isset($_COOKIE["session"]) || !isset($_COOKIE["login"]) || !checksession($_COOKIE["login"], $_COOKIE["session"])) {
    echo json_encode(["error" => "Error"]);
}
else if (!isset($_POST["id"]) || !isset($_POST["code"])) {
	echo json_encode(["error" => "Error"]);
}
else {
	echo json_encode(changestatus($_POST["id"], $_POST["code"]));
}