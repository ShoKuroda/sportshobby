<? if($_SERVER['REQUEST_URI'] == "/"){?>
<div class="bg_youtube">
    <img src="/img/youtube_top.gif" width="210" height="35" class="v_bottom" />
    <div class="youtube_body">
      <object width="200" height="175"><param name="movie" value="http://www.youtube.com/v/fTsKNf2aUvs?hl=ja_JP"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/fTsKNf2aUvs?hl=ja_JP" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="200" height="175"></embed></object>
      <p class="f10">晴天！石切ロック！<img src="/img/youtube_icon.gif" width="17" height="15" class="v_bottom" /></p>
    </div>
    <img src="/img/youtube_bottom.gif" width="210" height="8" class="v_top" />
</div>
<? } ?>
<img src="/img/item_top.gif" width="220" height="25" class="v_bottom item_list_img" />
<?=$this->requestAction(array('controller' => 'commons', 'action' => 'side_menu'), array('return'));?>
<!--p id="mobaile">携帯からショッピングができる！今すぐアクセス！！</p-->
<a href="http://ameblo.jp/sportshobby/" target="_blank"><img src="/img/btn_blog.gif" width="220" height="124" style="padding-top:10px;" /></a>
