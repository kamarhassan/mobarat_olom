<?php

header('Content-Type: text/csv');
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=out.csv');
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
//header('Content-Length: ' . strlen('sdfsd'));
echo 'sdfsd';


exit();


