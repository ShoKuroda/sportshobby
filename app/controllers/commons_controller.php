<?php
class CommonsController extends AppController{
	var $uses = array('Category');

    //サイドメニュー生成
	function side_menu() {	
		//キャッシュの判断
		Cache::set(array('duration' => '+1 day'));
		if((Cache::read('big_menu')) === false ){
		
			$fields = array(
				'conditions' => array("category_cd like ?"=>"__", "display"=>"1"),
				'fields' => array("category_cd","category","category_name"),
				'order' => array("id"=>"asc","order" => "asc"),
			);
			$big_menu = $this->Category->find('all',$fields);
			
			foreach($big_menu as $bk=>$bv){
				
				$fields = array(
					'conditions' => array("category_cd like ?"=>$bv["Category"]["category_cd"]."__", "display"=>"1"),
					'fields' => array("category_cd","category","category_name"),
					'order' => array("category_cd"=>"asc","order" => "asc"),
				);
				$middele_menu[$bv["Category"]["category_cd"]] = $this->Category->find('all',$fields);
				
				foreach($middele_menu[$bv["Category"]["category_cd"]] as $mk=>$mv){
					$fields = array(
						'conditions' => array("category_cd like ?"=>$mv["Category"]["category_cd"]."__", "display"=>"1"),
						'fields' => array("category_cd","category","category_name"),
						'order' => array("category_cd"=>"asc","order" => "asc"),
					);
					$small_menu[$mv["Category"]["category_cd"]] = $this->Category->find('all',$fields);
					
					foreach($small_menu[$mv["Category"]["category_cd"]] as $sk=>$sv){
						$fields = array(
							'conditions' => array("category_cd like ?"=>$sv["Category"]["category_cd"]."__", "display"=>"1"),
							'fields' => array("category_cd","category","category_name"),
							'order' => array("category_cd"=>"asc","order" => "asc"),
						);
						$detail_menu[$sv["Category"]["category_cd"]] = $this->Category->find('all',$fields);
					
					}
				}
			}
			Cache::set(array('duration' => '+1 day'));
			Cache::write('big_menu' , $big_menu);
			Cache::set(array('duration' => '+1 day'));
			Cache::write('middele_menu' , $middele_menu);
			Cache::set(array('duration' => '+1 day'));
			Cache::write('small_menu' , $small_menu);
			Cache::set(array('duration' => '+1 day'));
			Cache::write('detail_menu' , $detail_menu);
			$this->set("big_menu",$big_menu);
			$this->set("middele_menu",$middele_menu);
			$this->set("small_menu",$small_menu);
			$this->set("detail_menu",$detail_menu);
		}else{
			$this->set("big_menu",Cache::read('big_menu'));
			$this->set("middele_menu",Cache::read('middele_menu'));
			$this->set("small_menu",Cache::read('small_menu'));
			$this->set("detail_menu",Cache::read('detail_menu'));
		}

	}
	

}
?>