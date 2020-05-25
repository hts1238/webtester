<?php

// tasks.php [session] => list of tasks (they redirect to task.php {id, [type]}

include_once("functions.php");

if (!isset($_COOKIE["session"]) || !checksession($_COOKIE["session"])) {
    header("Location: login");
}

echo "<h1>Tasks</h1>";