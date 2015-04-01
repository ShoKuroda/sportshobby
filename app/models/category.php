<?php
class Category extends AppModel {
	//カテゴリCSV登録
	function loadFromCSV_CATEGORY($fileName) {
		$file = file_get_contents($fileName);
		$file = explode("\n".'"',$file);
		$i=0;
		foreach($file as $key => $val){
			mb_convert_variables('UTF-8','SJIS',$val);
			unset($CategoryData);

			$line[$key] = explode('","',$val);
			if(!$i == 0){
				if(!(count($line[$key]) == 7)){
					print_r($line[$key][1].'<br />');
					continue;
				}else{
					$CategoryData["Category"]["item_url"] = $line[$key][1];
					$CategoryData["Category"]["category"] = $line[$key][3];
					
					$primary = $this->find('first',array('conditions' => array('Category.item_url' => $line[$key][1]), 'fields' => array('Category.id')));
					
					if($primary){
						$CategoryData["Category"]["id"] = $primary["Category"]["id"];
						$this->save($CategoryData);
					}else{
						$this->create();
						$this->save($CategoryData);
					}
				}			
			}
			$i++;
		}
		return true;
	}
	
	//カテゴリー表示
	function select_category($v){
		$fields = array(
                    "conditions" => array("Category.category like ?"=>$v."%"),
					"fields"=>array("category","category_name"),
                  );
		
		$value = $this->find('all',$fields);
		return $value;
	}
	
}
?>