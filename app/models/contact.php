<?php

//if($_SERVER['REQUEST_URI']);


class Contact extends AppModel {
	public $name = 'Contact';
	public $actsAs = array('Cakeplus.AddValidationRule');
	
	var $useTable = false;  //データベースのテーブルを使用しない
	
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '名前を入力してください'
			),
		),
		'kana' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'フリガナを入力してください'
			),
			'katakana_only' => array(
				'rule' => 'katakana_only',
				'message' => 'カタカナを入力してください'
			),
		),
		'mail' => array(
			'email' => array(
				'rule' => 'email',
				'message' => '正しいメールアドレスを入力してください'
			),
		),
		'tell' => array(
			'phone' => array(
				'rule' => array('phone',"/\d{2,4}-\d{2,4}-\d{4}/"),
				'message' => 'ハイフンを入れて正しい電話番号を入れてください'
			),
		),
		'address1' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '住所（市区町村）を入力してください'
			),
		),
		'message' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'お問い合わせを入力してください'
			),
		),
	);
}
?>