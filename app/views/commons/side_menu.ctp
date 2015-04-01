<?
echo '<ul class="big_menu">';
foreach($big_menu as $bk=>$bv){
	$link_b = $bv["Category"]["category"];
	echo '<li><a href="/'.$link_b.'/">';
	echo ($bv["Category"]["category_name"])?($bv["Category"]["category_name"].'</a>'):($bv["Category"]["category"].'</a>');
	//middleがあれば
	if($middele_menu[$bv["Category"]["category_cd"]]){
		echo '<ul class="middle_menu">';
		foreach($middele_menu[$bv["Category"]["category_cd"]] as $mk=>$mv){
			$link_m = str_replace("\\","-",$mv["Category"]["category"]);
			$link_m = str_replace("/","／",$link_m);
			if($small_menu[$mv["Category"]["category_cd"]]){
				echo '<li class="arrow"><a href="/'.$link_m.'/">';
			}else{
				echo '<li><a href="/'.$link_m.'/">';
			}
			$middele_disp = ($mv["Category"]["category_name"])?($mv["Category"]["category_name"]):(array_pop(explode("\\",$mv["Category"]["category"])));
			echo $middele_disp.'</a>';
			//smallがあれば
			if($small_menu[$mv["Category"]["category_cd"]]){
				echo '<ul class="small_menu">';
				echo '<li class="small_title">'.$middele_disp.'</li>';
				foreach($small_menu[$mv["Category"]["category_cd"]] as $sk=>$sv){
					$link_s = str_replace("\\","-",$sv["Category"]["category"]);
					$link_s = str_replace("/","／",$link_s);
					if($detail_menu[$sv["Category"]["category_cd"]]){
						echo '<li class="arrow"><a href="/'.$link_s.'/">';
					}else{
						echo '<li><a href="/'.$link_s.'/">';
					}
					$small_disp = ($sv["Category"]["category_name"])?($sv["Category"]["category_name"]):(array_pop(explode("\\",$sv["Category"]["category"])));
					echo $small_disp.'</a>';
					//detailがあれば
					if($detail_menu[$sv["Category"]["category_cd"]]){
						echo '<ul class="detail_menu">';
						echo '<li class="small_title">'.$small_disp.'</li>';
						foreach($detail_menu[$sv["Category"]["category_cd"]] as $dk=>$dv){
							$link_d = str_replace("\\","-",$dv["Category"]["category"]);
							$link_d = str_replace("/","／",$link_d);
							echo '<li><a href="/'.$link_d.'/" style="background-image:none;">';
							$detail_disp = ($dv["Category"]["category_name"])?($dv["Category"]["category_name"]):(array_pop(explode("\\",$dv["Category"]["category"])));
							echo $detail_disp.'</a>';
							echo '</li>';
						}
						echo '</ul>';
					}
					//detail終わり
					echo '</li>';
				}
				echo '</ul>';
			}
			//small終わり
			echo '</li>';
		}
		echo '</ul>';
	}
	//middle終わり
	echo '</ll>';
}
echo '</ul>';
