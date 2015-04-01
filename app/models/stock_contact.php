<?php
class StockContact extends AppModel {
	public $name = 'StockContact';
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
	);
}
?>