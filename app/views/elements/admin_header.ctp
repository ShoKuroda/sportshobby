<script type="text/javascript">
$(function() {
	$("#header_ul li.t").hover(function() {
		$(this).children().toggleClass("drop");
	})
});
</script>
<ul id="header_ul">
	<li class="t">商品管理
		<ul class="hidden">
			<li><a href="/admin/items/list">商品管理</a></li>
			<li><a href="/admin/categories/list">カテゴリー管理</a></li>
			<li><a href="/admin/item_questions/item_question">商品の質問管理</a></li>
			<li><a href="/admin/item_answers/item_answer">商品の回答管理</a></li>
		</ul>
	</li>
	<li class="t">商品登録
		<ul class="hidden">
			<li><a href="/admin/items/item_add">[CSV] 商品登録</a></li>
			<li><a href="/admin/items/category_add">[CSV] カテゴリ登録</a></li>
		</ul>
	</li>
	<li class="t">情報管理
		<ul class="hidden">
			<li><a href="/admin/new_infos/list">新着情報</a></li>
			<li><a href="/admin/used_infos/list">中古情報</a></li>
		</ul>
	</li>
	<li class="t">知恵袋
		<ul class="hidden">
			<li><a href="/admin/rc_questions/list">質問</a></li>
			<li><a href="/admin/rc_answers/list">回答</a></li>
		</ul>	
	</li>
	<li class="t">その他
		<ul class="hidden">
			<li><a href="/admin/ngauge_calendars/list">鉄道入荷カレンダー</a></li>
			<li><a href="/admin/rc_dictionaries/list">ラジコン用語集</a></li>
			<li><a href="/admin/blogs/list">ブログ管理</a></li>
		</ul>	
	</li>
</ul>
<span style="display:block; clear:both;"></span>