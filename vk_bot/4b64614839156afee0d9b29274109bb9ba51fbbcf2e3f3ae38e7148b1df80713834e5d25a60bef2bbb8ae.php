<?php

$data = json_decode(file_get_contents('php://input'));

$event_id = $data->type;

$f = fopen("output.txt", "a");

fwrite($f, $event_id."\n");

file_get_contents('https://api.vk.com/method/messages.send?message=Hi&user_id=427299132&access_token=6a3453075b05fb0333d9851f22d17f165884745ec9ceec8350e97ca7a84f54f31ac211a194153788632c8&v=5.50');
