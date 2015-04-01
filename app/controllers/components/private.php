<?php

class PrivateComponent extends Object {

    function html_del_tag($arr,$model) {
		if(is_array($arr[$model])){
			foreach($arr[$model] as $key => $val){
				$val = strip_tags($val);
				$arr[$model][$key] = $val;
			}
		}
		return $arr;
	}
}

