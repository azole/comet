<?php

// 如果沒有這一行的話，會無法片段輸出...
header( 'Content-type: text/json; charset=utf-8' );

ob_end_clean();	// 把flush關掉並清空，只關掉也可以ob_end_flush();
date_default_timezone_set('Asia/Taipei');

$i = 0;
while(true && $i++<3) 
{	
	$str = date('Y/m/d H:i:s');
	$data = array('dt' => $str);
	echo json_encode($data);
	flush();   
	sleep(1);
}
