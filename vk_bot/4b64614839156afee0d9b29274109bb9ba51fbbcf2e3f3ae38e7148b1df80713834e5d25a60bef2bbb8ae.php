<?php

$data = json_decode(file_get_contents('php://input'));

$event_id = $data->type;

$f = fopen("output.txt", "a");

fwrite($f, $event_id."\n");
