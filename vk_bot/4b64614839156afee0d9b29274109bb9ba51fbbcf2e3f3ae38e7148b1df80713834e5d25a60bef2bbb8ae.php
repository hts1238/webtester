<?php

<?php

$event_id = $_POST["event_id"] ?? "smt wrong";

$f = fopen("output.txt", "a");

fwrite($f, $event_id."\n");
