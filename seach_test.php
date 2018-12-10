<?php header("Content-type: text/html; charset=utf-8");?>

<?php

function binary_seach($file, $seach_key){
	$handle = fopen($file, "r");
	
	while (!feof($handle)){
	
		$string = fgets($handle, 4000);
		$explodedstring = explode('\x0A', $string);

		array_pop($explodedstring);
		
		foreach ($explodedstring as $key => $value){
			$arr[] = explode('\t', $value);
		}

		$begin = 0;
		$end = count($arr) - 1;

 		while ($begin <= $end){
			$middle = floor(($begin + $end) / 2);
			$strnatcmp = strnatcmp($arr[$middle][0], $seach_key);
			if ($strnatcmp > 0){
				$end = $middle - 1;
			}
			elseif ($strnatcmp < 0){
				$begin = $middle + 1;
			}
			else {
				return $arr[$middle][1];
			}
		} 
	}
	return 'undef';
}
$seach_key = 'ключ90';
$file = 'test.txt';
echo binary_seach($file, $seach_key)."</br>";
?>
