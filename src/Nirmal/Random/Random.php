<?php 
namespace Nirmal\Random;

class Random {
	public static $font = '/monofont.ttf';	
     
	public static function randomNumber($min=1,$max=20){
		return rand($min, $max);
	}
	
	public static function getRealIpAddr(){
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
		//return '75.128.223.139';
        return $ip;
    }
	
	public static function generatePassword ($length = 8){        
        
        $password = "";
        $i = 0;
        $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
        
        while ($i < $length){
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
            
            if (!strstr($password, $char)) { 
                $password .= $char;
                $i++;
            }
        }
        
        return $password;
    }
	
	public static function getSalt() {
		$validSalt = 'acbdefghijklmnopqrstuvwxyz1234567890';
		$saltLength=strlen($validSalt);

		//We want an 8 character salt key mixed from the values above
		$salt='';
		for ($i = 0; $i<6; $i++) {
			//pick a random number between 0 and the max of validsalt
			$rand=mt_rand(0, $saltLength);
			//grab the char at that position
			$selectedChar=substr($validSalt, $rand, 1);
			$salt = $salt . $selectedChar;
		}
		return $salt;
	}
	
	public static function generatePasswd($numAlpha=6,$numNonAlpha=2){
	   $listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	   $listNonAlpha = ',;:!?.$/*-+&@_+;./*&?$-!,';
	   return str_shuffle(
		  substr(str_shuffle($listAlpha),0,$numAlpha) .
		  substr(str_shuffle($listNonAlpha),0,$numNonAlpha)
		);
	}
	
	public static function unicode_shuffle($string, $chars, $format = 'UTF-8'){
		for($i=0; $i<$chars; $i++)
			$rands[$i] = rand(0, mb_strlen($string, $format));
			   
			$s = NULL;
			   
		foreach($rands as $r)
			$s.= mb_substr($string, $r, 1, $format);
			   
		return $s;
	}
	
	public static function scramble_word($word) {
        if (strlen($word) < 2)
            return $word;
        else
            return $word{0} . str_shuffle(substr($word, 1, -1)) . $word{strlen($word) - 1};
    }
	
	public static function random_password($chars = 8) {
	   $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	   return substr(str_shuffle($letters), 0, $chars);
	}
	
	public static function RandomPass($numchar){ 
		$word = "a,b,c,d,e,f,g,h,i,j,k,l,m,1,2,3,4,5,6,7,8,9,0"; 
		$array=explode(",",$word); 
		shuffle($array); 
		$newstring = implode($array,""); 
		return substr($newstring, 0, $numchar); 
	}
	
	public static function str_shuffle_unicode($str) {
		$tmp = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		shuffle($tmp);
		return join("", $tmp);
	}
		   
	public static function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}

	public static function create($width='120',$height='40',$characters='6') {
		$font = __dir__ . self::$font;
		$code = self::generateCode($characters);
                
		/* font size will be 75% of the image height */
		$font_size = $height * 0.70;
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 214, 214, 214);
		
		$text_color = imagecolorallocate($image, 230, 35, 114);
		$noise_color = imagecolorallocate($image, 255, 255, 255);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		$y -= 5;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code) or die('Error in imagettftext function');
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);		
	}

	
	
}
?>