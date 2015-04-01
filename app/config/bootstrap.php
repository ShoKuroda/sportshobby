<?php
//サイト設定
define('SITE_TITLE','ラジコンショップ｜スポーツホビー');
define('SITE_DESCRI','ラジコン,通販,販売');
define('SITE_KEYW','札幌でラジコンを購入するならスポーツホビーへ！通販もお任せ下さい！');


define('RAKUTEN_SHOPID','243411-00');
//define('MASTER_MAIL','sho.kuroda@gmail.com');
define('MASTER_MAIL','hobby.division@sportshobby.co.jp');
define('MASTER_NAME','スポーツホビー');

//配列はファンクションで渡す
function select_category(){
	$category = array(
					"nc"=>"-------カテゴリ-------",
					"飛行機"=>"飛行機",
					"ヘリコプター"=>"ヘリコプター",
					"ラジコンカー"=>"ラジコンカー",
					"ガン"=>"ガン",
					"雑貨"=>"雑貨",
					"塗料"=>"塗料",
					"工具"=>"工具",
					"燃料"=>"燃料"
				);
	return $category;
}

/*デバッグをファイルに出力する場合
if ( Configure::read('debug') == 0 )
{
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', LOGS . DS . 'php_error.log');
}
*/