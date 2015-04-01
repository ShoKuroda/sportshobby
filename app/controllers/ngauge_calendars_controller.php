<?php
class NgaugeCalendarsController extends AppController{
	
	var $uses = array('NgaugeCalendar');
	var $paginate = array(
		'conditions' => NULL,
		'fields' => "NgaugeCalendar.*",
		'limit' => 50,
		'order' => array('year' => 'desc','month' => 'desc'),
	);
	var $helpers = array('Image','text');
	
	//事前処理(urlにadminがあるときレイアウトを変更)
	function beforeRender() {
		parent::beforeFilter();
		if (isset($this->params['admin']) && true === $this->params['admin']) {
			$this->layout = 'admin';
		}
	}
	
	//管理画面
	function admin_list() {
		//テーブル名を定義
		$TABLE_NAME = "NgaugeCalendar";
		$this->set('TABLE_NAME', $TABLE_NAME);
		$POST_COLUMN = array("year","month","tomix","micro_ace","kato","other");
		$IMG_CNT = 0;
		$IMG_DIR = "/img/used_info/";
		$this->set('IMG_DIR', $IMG_DIR);		
		$IMG_CNT = $IMG_CNT + 1;
		
		//登録時に別のテーブルから値を読むSET		
		//$this->set('info_category', $this->OtherCategory->find('list',array("fields" => array("category_cd","category_name"))));
		$this->set('year',array('2011','2012','2013'));
		$this->set('month',array('1','2','3','4','5','6','7','8','9','10','11','12'));		
		
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
		/*
		if(!empty($this->params['url']['category']) || !empty($this->params['named']['category'])){
			$category = (!empty($this->params['url']['category']))?$this->params['url']['category']:$this->params['named']['category'];
			$fields[] = array("category"=>$category,);
			$this->set('value_category', $category);
		}else{
			$fields[] = array(1);
			$this->set('value_category', false);
		}
		*/
		(!empty($fields))?"":$fields = array(1);
		$this->set('Info', $this->paginate($TABLE_NAME,array("and"=>$fields)));
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
	
}
?>