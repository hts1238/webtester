<?php

$name = $_POST["name"] ?? "smt wrong";

$f = fopen("output.txt", "a");

fwrite($f, $name."\n");
