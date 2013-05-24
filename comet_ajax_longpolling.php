<?php
date_default_timezone_set('Asia/Taipei');
$str = date('Y/m/d H:i:s');
$data = array('dt' => $str);
echo json_encode($data);
sleep(1);
exit(); 