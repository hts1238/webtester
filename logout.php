<?php

setcookie("login", "", time()-1, "./");
setcookie("session", "", time()-1, "./");

header("Location: index");