<?php

if(preg_match('/co.jp/',$_SERVER['HTTP_HOST'])){
	class DATABASE_CONFIG {
		var $default = array(
			'driver' => 'mysql',
			'persistent' => false,
			'host' => 'mysql101b.db.sakura.ne.jp',
			'login' => 'sportshobby2',
			'password' => 'avuk335b22',
			'database' => 'sportshobby2',
			'encoding' => 'utf8',
			'prefix' => '',
		);
	}
}else{
	class DATABASE_CONFIG {
		var $default = array(
			'driver' => 'mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => 'root',
			'password' => 'cctmcctm',
			'database' => 'sportshobby2',
			'encoding' => 'utf8',
			'prefix' => '',
		);
	}
}
