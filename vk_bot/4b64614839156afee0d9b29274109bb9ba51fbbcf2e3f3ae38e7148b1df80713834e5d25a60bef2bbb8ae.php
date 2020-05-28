<?php

$event_id = print_r($_REQUEST);

$f = fopen("output.txt", "a");

fwrite($f, $event_id."\n");
