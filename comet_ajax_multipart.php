<?php

// 如果沒有這一行的話，會無法片段輸出...
header('Content-type: multipart/x-mixed-replace; boundary=endofsection');
echo "\n--endofsection\n";

ob_end_clean();	// 把flush關掉並清空，只關掉也可以ob_end_flush();
date_default_timezone_set('Asia/Taipei');

$i = 0;
while(true && $i++<3) 
{	
	echo "Content-type: text/plain\n\n";
	$str = date('Y/m/d H:i:s');	
	echo $str;
	echo "--endofsection\n";
	flush();   
	sleep(1);
}
echo "Content-type: text/plain\n\n";
echo "end";
echo "--endofsection\n";
flush(); 