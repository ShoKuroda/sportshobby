<?php
class ItemsController extends AppController{
	
	var $uses = array('Item','Category','ItemQuestion','ItemAnswer');
	var $components = array('Semail','RequestHandler');
	var $paginate = array(
		'conditions' => NULL,
		'fields' => "Item.*",
		'limit' => 50,
		'order' => array('Item.rac' => 'asc'),
	);
	
	//事前処理
	function beforeRender() {
		parent::beforeFilter();
		if (isset($this->params['admin']) && true === $this->params['admin']) {
			$this->layout = 'admin';
		}
	}
	
	//アイテムリスト
	function item_list() {
		//リダイレクト処理でできなかったURLの整理を下記で行う
		if(preg_match("/page[0-9]*.html$/",$_SERVER['REQUEST_URI'])){
			preg_match_all("/page([0-9]*).html$/",$_SERVER['REQUEST_URI'],$number);
			$redirect_url = preg_replace("/page[0-9]*.html$/","",$_SERVER['REQUEST_URI']);
			if($number[1][0] != 0){
				$this->redirect($redirect_url.$number[1][0]);
			}else{
				$this->redirect($redirect_url);
			}
		}
		
		//カテゴリーがあるか調べる（なければエラーページにリダイレクト）
		$category = str_replace("-", "\\", $this->params['category']);
		$category = str_replace("／", "/", $category);
		$fields = array(
                    "conditions" => array("category"=>$category),
                    "fields" => array("id"),
                  );
		$cheack_category = $this->Category->find('all',$fields);
		
		if(!$cheack_category){
			$this->redirect('/error');
		}else{
			$this->paginate = array(
								'conditions'=> array('category like'=>str_replace("-", "\\\\", $this->params['category']).'%'),
								'fields'=>array('rac','item_name','img_url','category','sell_price','pc_katch_copy','stock','item_url'),
								'limit'=>25,
								'order'=>array("modified desc, rac desc"),
							);
			$this->set('item', $this->paginate('Item'));
			$this->set('category',$this->params['category']);
			//sortのセレクト		
			$this->set('sort_select', array("created"=>"登録日で並び替え","place"=>"金額で並び替え"));
		}
		
	}
	
	//アイテム詳細
	function item_detail() {
		
		//リダイレクト処理でできなかったURLの整理を下記で行う
		if(preg_match("/.html$/",$_SERVER['REQUEST_URI'])){
			$redirect_url = preg_replace("/.html/","",$_SERVER['REQUEST_URI']);
			$this->redirect($redirect_url);
		}
		
		$rac = RAKUTEN_SHOPID.$this->params['rac'];
		$fields = array(
                    "conditions" => array("rac"=>$rac),
                  );
		$item_detail = $this->Item->find('first',$fields);
		
		$fields = array(
                    "conditions" => array("item_id"=>$rac,"permission"=>"1"),
                  );
		$question_detail = $this->ItemQuestion->find('all',$fields);
		$answer_detail = array();
			foreach($question_detail as $val){
				$fields = array(
						"conditions" => array("question_id"=>$val["ItemQuestion"]["id"],"permission"=>"1"),
					  );		
				$answer_detail[$val["ItemQuestion"]["id"]] = $this->ItemAnswer->find('all',$fields);
			}
		if(!$item_detail){
			$this->redirect('/error');
		}else{
			$this->set('item', $item_detail);
			$this->set('question', $question_detail);
			$this->set('answer', $answer_detail);
		}
	}
	
	//アイテム検索
	function item_search() {
		$search_text = (isset($this->params['search_text']))?($this->params['search_text']):($this->params['url']['search_text']);
		$search_category = (isset($this->params['search_category']))?($this->params['search_category']):($this->params['url']['search_category']);
		$q_word = trim(mb_convert_kana($search_text, 's'));
		$q_word = preg_split('/[ \t\n\r]+/u', $q_word);
		
		$conditions = array();
		foreach($q_word as $q){
			$conditions['AND'][] = array("Item.item_name LIKE"=>"%$q%");
			if($search_category and $search_category != "nc"){
				$conditions['AND'][] = array("Item.category LIKE"=>$search_category."%");
			}
		}
		
		$this->paginate = array(
			'conditions'=> $conditions,
			'limit'=>30,
		);

		$this->set('item', $this->paginate('Item'));
		$this->set('search_text',$search_text);
		$this->set('search_category',$search_category);

	}
	
	function ajax_search() {
		// デバッグ情報出力を抑制
		Configure::write('debug', 0);
		if($this->RequestHandler->isAjax()) {
					
			$db_settings = array(
				array('table'=>'Item', 'field'=>'item_name', 'order'=>'id')
			);
			
			$per_page = 20;
			$order_by = $this->params['url']['order_by'];
			$database = array($this->params['url']['database']);

			//全角空白でもトリム
			$q_word   = trim(mb_convert_kana($this->params['url']['q_word'], 's'));
			$q_word   = preg_split('/[ \t\n\r]+/u', $q_word);
						
			//----------------------------------------------------
			// findのパラメータをひとつずつ作成
			//----------------------------------------------------
			//field,conditions======================
			$conditions = array();
			$full_field;
			foreach($database as $num){
				$full_field = "Item.item_name";
				$field[] = $full_field;
				foreach($q_word as $q){
					$conditions['AND'][] = array("$full_field LIKE"=>"%$q%");
					if($this->params['url']['limit'] != "nc"){
						$conditions['AND'][] = array("Item.category LIKE"=>$this->params['url']['limit']."%");
					}
				}
			}
			//order======================
			$order = array();
			$count = 0;
			$order[0] = "(CASE ";
			foreach($database as $num){
				foreach($q_word as $q){
					 $order[0] .= "WHEN $full_field LIKE '$q%' THEN $count ";
					 $count++;
				}
			}
			$order[0] .= "ELSE $count END) ";
			foreach($database as $db){
				$order[] = "$full_field $order_by";
			}
			//パラメータを設定======================
			$params = array(
				'conditions'=>$conditions,
				'order'     =>$order,
				'per_page'  =>$per_page,
				'recursive' =>0,
				'limit'		=>20
			);
			
			//----------------------------------------------------
			// DB問い合わせ。JSON化
			//----------------------------------------------------
			$data = $this->Item->find('all', $params);

			$simple_data = array();
			foreach($data as $val){
				$simple_data[] = $val['Item']['item_name'];
			}		
			$this->set('json', json_encode($simple_data));
		}		
	}
	
	//商品管理画面
	function admin_list() {
		
		//オススメ登録用配列
		$reccomend_category = array("0"=>"なし","1"=>"店長","2"=>"流行","3"=>"激安");
		$this->set('reccomend_category', $reccomend_category);
		//オススメ登録があれば
		if(!empty($this->params['data']['Item']['id'])){
			$ItemData["Item"]["reccomend"] = $this->params['data']['Item']['reccomend_category'];
			$ItemData["Item"]["id"] = $this->params['data']['Item']['id'];
			$this->Item->save($ItemData);
		}
		
		
		//検索条件がある場合
		//商品名
		if(!empty($this->params['url']['item_name']) || !empty($this->params['named']['item_name'])){
			$item_name = (!empty($this->params['url']['item_name']))?$this->params['url']['item_name']:$this->params['named']['item_name'];
			$item_fields[] = array("Item.item_name like"=>"%".$item_name."%",);
			$this->set('value_item_name', $item_name);
		}else{
			$item_fields[] = array(1);
			$this->set('value_item_name', false);
		}
		//カテゴリー
		if(!empty($this->params['url']['category']) || !empty($this->params['named']['category'])){
			$category_cd = (!empty($this->params['url']['category']))?$this->params['url']['category']:$this->params['named']['category'];
			$category = $this->Category->find('first',array("conditions"=>"Category.category_cd = {$category_cd}","fields"=>"Category.category"));
			$category = addslashes($category["Category"]["category"]);
			$item_fields[] = array("Item.category like"=>$category."%");
			$this->set('value_category', $category_cd);
		}else{
			$item_fields[] = array(1);
			$this->set('value_category', false);
		}
		//オススメ
		if(!empty($this->params['url']['reccomend']) || !empty($this->params['named']['reccomend'])){
			$reccomend = (!empty($this->params['url']['reccomend']))?$this->params['url']['reccomend']:$this->params['named']['reccomend'];
			$item_fields[] = array("Item.reccomend ="=>$reccomend);
			$this->set('value_reccomend', $reccomend);
		}else{
			$this->set('value_reccomend', false);
		}
		
		//検索条件がない場合
		(!empty($item_fields))?"":$item_fields = array(1);
		$this->paginate = array('order'=>array('rac'=>'desc'));
		$this->set('Item', $this->paginate('Item',array("and"=>$item_fields)));
		
		//カテゴリーのセレクトボックス作成
		$fields = array(
                    "conditions" => array("Category.category_cd < 9999 "),
                    "fields" => array("category_cd","category"),
                  );
		$search_list = $this->Category->find('list',$fields);		
		$this->set('Category', $search_list);

	}	
	
	//商品CSV登録
	function admin_item_add() {
		if (!empty($this->data)){
			$up_file = $this->data['Items']['result']['tmp_name'];
			$fileName = "files/item.csv";

			if (is_uploaded_file($up_file)){
				move_uploaded_file($up_file, $fileName);
				$error = $this->Item->loadFromCSV_ITEM($fileName);

				if(!$error){
					$this->Session->setFlash('<p class="err_msg">商品データをアップロードしました。</p>');
					$error_line_str = "正常にアップロードされました。";
				}else{
					$this->Session->setFlash('<p class="err_msg">商品データが正しくアップロードされませんでした。データに不備がないかチェックしてください。</p>');
					//エラーを文字列に変換
					$error_line_str = "フィールドの数が会わなかったITEM_URL"."\n";
					if($error["line"]){
						foreach($error["line"] as $key=>$val){
							$error_line_str .= $val."\n";
						}
					}
				}				
				//更新メールを送る
				$this->Semail->to['管理者'] = MASTER_MAIL;
				$this->Semail->from['スポーツホビー商品更新'] = 'admin@sportshobby.co.jp' ;
				$this->Semail->subject="スポーツホビー商品更新";
				$this->Semail->send('商品が更新されると自動的に送られます。'."\n\n".$error_line_str);
				
				$this->redirect('/admin/index');
			}
		}
	}

	//カテゴリーCSV登録
	function admin_category_add() {

		if (!empty($this->data)){
			$up_file = $this->data['Items']['result']['tmp_name'];
			$fileName = "files/category.csv";
			if (is_uploaded_file($up_file)){
				move_uploaded_file($up_file, $fileName);
				$error = $this->Item->loadFromCSV_CATEGORY($fileName);
				if(!$error){
					$this->Session->setFlash('<p class="err_msg">カテゴリーデータをアップロードしました。</p>');
					$error_line_str = "正常にアップロードされました。";
					$error_no_item_str = " ";
				}else{
					$this->Session->setFlash('<p class="err_msg">カテゴリーデータが正しくアップロードされませんでした。データに不備がないかチェックしてください。</p>');
					//エラーを文字列に変換
					$error_line_str = 'フィールドの数が会わなかったITEM_URL'."\n";
					$error_no_item_str = "\n".'カテゴリーとアイテムが一致しなかったITEM_URL'."\n";
					if($error["line"]){
						foreach($error["line"] as $key=>$val){
							$error_line_str .= $val."\n";
						}
					}
					if($error["no_item"]){
						foreach($error["no_item"] as $key=>$val){
							$error_no_item_str .= $val."\n";
						}
					}
				}
				//更新メールを送る
				$this->Semail->to['管理者'] = MASTER_MAIL;
				$this->Semail->from['スポーツホビー商品カテゴリー更新'] = 'admin@sportshobby.co.jp' ;
				$this->Semail->subject="スポーツホビー商品カテゴリー更新";
				$this->Semail->send('商品が更新されると自動的に送られます。'."\n\n".$error_line_str.$error_no_item_str);
				
				$this->redirect('/admin/index');
			}
		}
	}
}
?>