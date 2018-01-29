<?php

class cipher
{

	private $secret;
	private $iv;

	//3DES is the encription going to use in this class

	function __construct()
	{
		$this->secret = base64_encode('BlueBird');
		$this->iv = 'B!r67@x!';
	}
	
	
	/*
	*
	*
	**/
	public function encrypt($data)
	{
		$td = mcrypt_module_open('tripledes','','ecb','');
		mcrypt_generic_init($td,$this->secret,$this->iv);		
		$CipherText = mcrypt_generic($td,$data);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return $CipherText;
	}

	/*
	*
	*
	**/
	public function decrypt($data)
	{
		$td= mcrypt_module_open('tripledes','','ecb','');
		mcrypt_generic_init($td,$this->secret,$this->iv);
		$ClearText = mdecrypt_generic($td,$data);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return $ClearText;
	}

}

?>