<?php
$input = file_get_contents("php://input");
$file = fopen("elog.txt", "w");
fwrite($file, $input);
fclose($file);
?>