<?php 
namespace Nirmal\Random;

class Random {
	
	public static function randomNumber($min=1,$max=20){
		return rand($min, $max);
	}
	
}
?>