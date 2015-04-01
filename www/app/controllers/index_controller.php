<?php
class IndexController extends AppController{
	var $name = 'Index';
	var $uses = array('Item','Category','NewInfo','UsedInfo');
	var $components = array('Semail');

	
	function beforeRender() {
		parent::beforeFilter();
		if (isset($this->params['admin']) && true === $this->params['admin']) {
			$this->layout = 'admin';
		}
	}
	
    //トップ
	function index() {
		//スポーツホビー情報
		$fields = array(
					'conditions' => NULL,
					'fields' => "*",
					'limit' => 50,
					'order' => array('NewInfo.id' => 'desc'),
					"joins" => array(
                                     array("type" => "LEFT",
                                           "table" => "other_categories",
                                           "alias" => "OtherCategory",
                                           "conditions" => "OtherCategory.category_cd = NewInfo.category",
                                          ),
                               ),
                  );
		$new_info_s = $this->NewInfo->find('all',$fields);
		$this->set('new_info_s', $new_info_s);
		
		//中古入荷情報
		$fields = array(
					'conditions' => NULL,
					'fields' => "*",
					'limit' => 50,
					'order' => array('UsedInfo.id' => 'desc'),
					"joins" => array(
                                     array("type" => "LEFT",
                                           "table" => "other_categories",
                                           "alias" => "OtherCategory",
                                           "conditions" => "OtherCategory.category_cd = UsedInfo.category",
                                          ),
                               ),
                  );
		$used_info_s = $this->UsedInfo->find('all',$fields);
		$this->set('used_info_s', $used_info_s);
		
		//新着商品
		$fields = array(
					'conditions' => array("new_flg"=>"1"),
					'fields' => array("id","item_name","pc_detail","sell_price","category","modified"),
					'limit' => 10,
					'order' => array("modified desc"),
                  );
		$new_item_s = $this->Item->find('all',$fields);
		$this->set('new_item_s', $new_item_s);
		
		
		//おすすめアイテム
		for($i=1;$i<4;$i++){
			$fields = array(
						'conditions' => array("reccomend"=>$i),
						'fields' => array("id","item_name","pc_katch_copy","sell_price","category","img_url","reccomend","rac"),
						'limit' => 6,
						'order' => array("modified desc"),
					  );
			${"reccomend_".$i} = $this->Item->find('all',$fields);
			$this->set("reccomend_".$i, ${"reccomend_".$i});
		}
				
		//6カテゴリ－の配列を回してアサイン
		//$new_item_s = array("air"=>"飛行機","hili"=>"ヘリコプター","car"=>"ラジコンカー","n_gauge"=>"鉄道模型Ｎゲージ","gun"=>"ガン","zakka"=>"雑貨");
		$new_item_s = array("air"=>"飛行機","hili"=>"ヘリコプター","car"=>"ラジコンカー","gun"=>"ガン","zakka"=>"雑貨");
		foreach($new_item_s as $key => $val){
			//キャッシュの判断
			Cache::set(array('duration' => '+1 day'));
			if(Cache::read($key.'_item_s') === false ){
				$fields = array('conditions' => array("category like" =>$val."%" ),'fields' => array("id","item_name","category","img_url","rac","created"),'limit' => 4,'order' => array("modified desc"),);
				${$key."_item_s"} = $this->Item->find('all',$fields);
				Cache::set(array('duration' => '+1 day'));
				Cache::write($key.'_item_s' , ${$key."_item_s"});
				$this->set($key.'_item_s', ${$key."_item_s"});
				
			}else{
				$this->set($key.'_item_s', Cache::read($key.'_item_s'));
			}
		}		
		
	}
	
	//管理画面トップ
	function admin_index() {

	}

}
?>