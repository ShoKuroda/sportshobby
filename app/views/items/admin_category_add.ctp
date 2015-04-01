<script type="text/javascript">
this.screenshotPreview = function(){	
		xOffset = 10;
		yOffset = 30;
	/* END CONFIG */
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};
$(document).ready(function(){
	screenshotPreview();
});
</script>
<p class="admin_pankuz"><a href="/admin/index">管理画面トップ</a> > [CSV] カテゴリー登録</p>

<div class="info_box" style="margin-bottom:30px;">
<p>
1. 楽天管理画面の「商品ページ設定」＞「<a href="#" class="screenshot" rel="/img/admin/add_item_step1.gif">CSV更新（変更・削除）</a>」のなかにあるカテゴリー更新フォーマットでダウンロードの下にある<a href="#" class="screenshot" rel="/img/admin/add_item_step3.gif">全商品にチェック</a>を入れてCSVをダウンロードします。 <br />
2. 5分後ぐらいにCSVファイルが楽天サーバーに作成されるので<a href="http://www2.biglobe.ne.jp/~sota/ffftp.html" target="_blank">FFFTP</a>（サーバー接続ソフト）で<a href="#" class="screenshot" rel="/img/admin/add_item_step4.gif">接続</a>します。PWは1ヶ月に1度ぐらいの頻度で変更されます。（2011/08/14現在　Sports12）
<br />
3.  /ritem/download/の中の商品詳細CSV（dl-item***********.csv）をダウンロードします。</p>
</div>

<?= $form->create('Items', array('action'=>'admin_category_add', 'type' => 'file'));?>

<?= $form->file('result');?>

<?= $form->end('アップロード');?>

