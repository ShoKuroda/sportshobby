<?php
class ItemAnswersController extends AppController{
	var $name = 'ItemAnswers';
	var $uses = array('ItemAnswer','ItemQuestion');
	var $paginate = array(
		'conditions' => NULL,
		'fields' => "ItemAnswer.*",
		'limit' => 50,
		'order' => array('ItemAnswer.created' => 'desc'),
	);
	var $helpers = array('Image');
	var $components = array('RequestHandler');
	
	//事前処理(urlにadminがあるときレイアウトを変更)
	function beforeRender() {
		parent::beforeFilter();
		if (isset($this->params['admin']) && true === $this->params['admin']) {
			$this->layout = 'admin';
		}
	}
	
	//管理画面
	function admin_item_answer() {
		//テーブル名を定義
		$TABLE_NAME = "ItemAnswer";
		$this->set('TABLE_NAME', $TABLE_NAME);
		$POST_COLUMN = array("question_id","answer_name","answer_detail","permission");
		$IMG_CNT = 0;
		$IMG_DIR = "/img/used_info/";
		$this->set('IMG_DIR', $IMG_DIR);		
		$IMG_CNT = $IMG_CNT + 1;
		
		//登録時に別のテーブルから値を読むSET		
		//$this->set('category', $this->Category->find('list',array("fields" => array("category_cd","category"))));
		$this->set('permission', array("非表示","表示"));
		
		//POSTがあれば
		if(!empty($this->params["form"])){
			($this->data[$TABLE_NAME]["id"])?$DATA[$TABLE_NAME]["id"] = $this->data[$TABLE_NAME]["id"]:"";
			foreach($POST_COLUMN as $COLUMN){
				$DATA[$TABLE_NAME][$COLUMN] = $this->data[$TABLE_NAME][$COLUMN];
			}
			//登録ボタンが押された時
			if(!empty($this->params["form"]["add"])){
				$this->$TABLE_NAME->create();
				$this->$TABLE_NAME->save($DATA);
				$INSERT_ID = $this->$TABLE_NAME->getLastInsertID();
				unset($DATA);
				for($i = 0; $i < $IMG_CNT; $i++) {
					if(!empty($this->data[$TABLE_NAME]["img".$i]['tmp_name'])){
						$ext = strtolower(preg_replace("!.*\.!", null, $this->data[$TABLE_NAME]["img".$i]['name']));
						$filename = $INSERT_ID.'_'.$i.'.'.$ext;
						move_uploaded_file($this->data[$TABLE_NAME]["img".$i]['tmp_name'], WWW_ROOT.$IMG_DIR.DS.$filename);
						$DATA[$TABLE_NAME]["id"] = $INSERT_ID;
						$DATA[$TABLE_NAME]["img".$i] = $filename;
						$this->$TABLE_NAME->save($DATA);
					}
				}
			//編集が押された時
			}elseif(!empty($this->params["form"]["edit"])){
				for($i = 1; $i < $IMG_CNT; $i++) {
					if(!empty($this->data[$TABLE_NAME]["img".$i]['tmp_name'])){
						$ext = strtolower(preg_replace("!.*\.!", null, $this->data[$TABLE_NAME]["img".$i]['name']));
						$filename = $this->data[$TABLE_NAME]["id"].'_'.$i.'.'.$ext;
						move_uploaded_file($this->data[$TABLE_NAME]["img".$i]['tmp_name'], WWW_ROOT.$IMG_DIR.DS.$filename);
						$DATA[$TABLE_NAME]["img".$i] = $filename;
					//画像の削除にチェックが押されたら
					}elseif(!empty($this->data[$TABLE_NAME]["img".$i."_del"]) && $this->data[$TABLE_NAME]["img".$i."_del"] != "0"){
						$filename = $this->data[$TABLE_NAME]["img".$i."_del"];
						$sam_filename = "sam_".$this->data[$TABLE_NAME]["img".$i."_del"];
						unlink(WWW_ROOT.$IMG_DIR.DS.$filename);
						unlink(WWW_ROOT.$IMG_DIR.DS.$sam_filename);
						$DATA[$TABLE_NAME]["img".$i] = false;
					}
				}
				$this->$TABLE_NAME->save($DATA);
			
			//削除が押された時
			}elseif(!empty($this->params["form"]["del"])){
				//TODO画像を削除するかどうか？
				//現在は削除をしないでファイルを残す
				$this->$TABLE_NAME->delete($this->data[$TABLE_NAME]["id"]);
			}
		}
		
		//検索条件がある場合
		//カテゴリー
		if(!empty($this->params['url']['category']) || !empty($this->params['named']['category'])){
			$category = (!empty($this->params['url']['category']))?$this->params['url']['category']:$this->params['named']['category'];
			$fields[] = array("category"=>$category,);
			$this->set('value_category', $category);
		}else{
			$fields[] = array(1);
			$this->set('value_category', false);
		}
		(!empty($fields))?"":$fields = array(1);
		
		//質問に対する回答のIDを配列に追加する
		$question_data = $this->paginate($TABLE_NAME,array("and"=>$fields));
		/*foreach($question_data as $key => $val){
			$answer_data = $this->RcAnswer->find('all',array("fields"=>array("id"),"conditions"=>array("question_id ="=>$val["RcQuestion"]["id"])));		
			if($answer_data){
				foreach($answer_data as $v){
					$answer_id[] = $v["RcAnswer"]["id"];
				}
				$answer_id = join(',',$answer_id);
				$question_data[$key]["RcQuestion"]["answer_id"] = $answer_id;
				unset($answer_id);
			}else{
				$question_data[$key]["RcQuestion"]["answer_id"] = false;
			}
		}*/

		$this->set('Info', $question_data);
		unset($fields);
		
		
		//編集モードの処理
		if(isset($this->params["url"]["edit"])){
			$fields = array(
				'conditions' => array("id"=>$this->params["url"]["edit"]),
				'fields' => "*",
			);
			$value = $this->$TABLE_NAME->find('first',$fields);
			foreach($value as $key=>$val){
				($value[$key])?$value[$key] = $val:$value[$key] = false; 
			}
		}else{
			$value = false;
			//$this->dataの値がフォームに残らないようにする最後にfalseを代入
			$this->data[$TABLE_NAME] = false;
		}
		$this->set('value', $value);

	}
	
	function ajax_item_answer() {
		// デバッグ情報出力を抑制
		Configure::write('debug', 0);
		if($this->RequestHandler->isAjax()) {
			$DATA["ItemAnswer"]["question_id"] = $_POST["question_id"];
			$DATA["ItemAnswer"]["answer_name"] = $_POST["answer_name"];
			$DATA["ItemAnswer"]["answer_detail"] = $_POST["answer_detail"];
			$this->ItemAnswer->create();
			$this->ItemAnswer->save($DATA);
			$INSERT_ID = $this->ItemAnswer->getLastInsertID();
			$this->set('answer_data', json_encode(array("question_id"=>$INSERT_ID)));
		}		
	}
	
	
}
?>