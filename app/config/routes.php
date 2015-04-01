<?php
	//コントローラーなし
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));	

	//トップページ
	Router::connect('/', array('controller' => 'index', 'action' => 'index'));
	
	//新着情報
	Router::connect('/new_info/', array('controller' => 'new_infos', 'action' => 'index'));
	Router::connect('/new_info/:page', array('controller' => 'new_infos', 'action' => 'index'), array('page'=>'[0-9]+',));
	
	//中古情報
	Router::connect('/used_info/', array('controller' => 'used_infos', 'action' => 'index'));
	Router::connect('/used_info/:page', array('controller' => 'used_infos', 'action' => 'index'), array('page'=>'[0-9]+',));
	
	//お問い合わせ
	Router::connect('/contact', array('controller' => 'contacts', 'action' => 'contact'));
	
	//ラジコン質問箱
	Router::connect('/rc_questions/', array('controller' => 'rc_questions', 'action' => 'index'));
	
	//在庫お問い合わせ
	Router::connect('/stock_contact', array('controller' => 'contacts', 'action' => 'stock_contact'));
	
	//コンテンツ
	Router::connect('/nine/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/crawling/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/drift/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/body/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/survival/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/other/*', array('controller' => 'pages', 'action' => 'display'));
		
	##下記は一致するURLが多いため最下部に記載する
	//アイテムリスト
	Router::connect('/:category/', array('controller' => 'items', 'action' => 'item_list'));
	Router::connect('/:category/:page', array('controller' => 'items', 'action' => 'item_list'), array('page'=>'[0-9]+',));
	//アイテム詳細
	Router::connect('/:item_name/item:rac', array('controller' => 'items', 'action' => 'item_detail'), array('rac'=>'[0-9]+',));
	//アイテム検索
	Router::connect('/items/item_search/:search_category/:search_text/:page', array('controller' => 'items', 'action' => 'item_search'), array('page'=>'[0-9]+',));
	
?>