<?php

$event_id = print_r(json_decode(file_get_contents('php://input'), true));

$f = fopen("output.txt", "a");

fwrite($f, $event_id."\n");
