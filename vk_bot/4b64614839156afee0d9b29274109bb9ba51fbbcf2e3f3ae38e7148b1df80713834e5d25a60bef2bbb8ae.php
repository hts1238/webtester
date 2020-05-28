<?php

$event_id = print_r($_POST, true);

$f = fopen("output.txt", "a");

fwrite($f, $event_id."\n");
