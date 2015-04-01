<?php

ini_set("memory_limit","512M"); 

class Item extends AppModel {
	//商品CSV登録
	function loadFromCSV_ITEM($fileName) {
		$file = file_get_contents($fileName);
		$file = explode("\n".'"",',$file);
		$i=0;
		foreach($file as $key => $val){
			mb_convert_variables('UTF-8','SJIS',$val);
			unset($CategoryData);

			if(!$i == 0){
			$line[$key] = explode('","',$val);
				if(!(count($line[$key]) == 59)){
					$error["line"][] = $line[$key][1];
					continue;
				}else{
					$ItemData["Item"]["rac"] = $line[$key][38];
					$ItemData["Item"]["item_name"] = $line[$key][6];
					$ItemData["Item"]["item_url"] = str_replace('"',"",$line[$key][0]);
					$ItemData["Item"]["pc_katch_copy"] = $line[$key][4];
					$ItemData["Item"]["pc_detail"] = $line[$key][23];
					$ItemData["Item"]["disp_price"] = $line[$key][8];
					$ItemData["Item"]["sell_price"] = $line[$key][7];
					$ItemData["Item"]["img_url"] = $line[$key][27];
					$ItemData["Item"]["stock"] = $line[$key][33];
					$primary = $this->find('first',array('conditions' => array('Item.rac' => $line[$key][38]), 'fields' => array('Item.id')));
					if($primary){
						$ItemData["Item"]["new_flg"] = 0;
						$ItemData["Item"]["id"] = $primary["Item"]["id"];
						$this->save($ItemData);
					}else{
						$ItemData["Item"]["new_flg"] = 1;
						$this->create();
						$this->save($ItemData);
					}
				}			
			}
			$i++;
		}
		if(isset($error)){
			return $error;
		}else{
			return false;
		}
	}

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
					$error["line"][] = $line[$key][1];
					continue;
				}else{
					//$CategoryData["Item"]["item_url"] = $line[$key][1];
					//$CategoryData["Item"]["item_name"] = $line[$key][2];
					$CategoryData["Item"]["category"] = $line[$key][3];
					
					$primary = $this->find('first',array('conditions' => array('Item.item_name' => $line[$key][2]), 'fields' => array('Item.id')));
					if($primary){
						$CategoryData["Item"]["id"] = $primary["Item"]["id"];
						$this->save($CategoryData);
					}else{
						$error["no_item"][] = $line[$key][1];
					}
				}			
			}
			$i++;
		}
		if(isset($error)){
			return $error;
		}else{
			return false;
		}
	}
	
	function item_list($v){
		$fields = array(
                    "conditions" => array("Item.category like ?"=>$v."%"),
					"limit"=>"10",

                  );
		
		$value = $this->find('all',$fields);
		return $value;
	}
	
	
}
?>