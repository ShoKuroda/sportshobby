<? 
$this->layout="no_action";
$this->set('title', 'サバイバルゲーム初体験');
$this->set('h1', 'サバイバルゲーム初体験：入門編');
$this->set('keywords', "GUN,サバイバルゲーム");
$this->set('description', "サバイバルゲーム初心者の為の準備・実践・戦術テクニック集！！");
?>

<h2 class="pages">サバイバルゲーム - 入門編</h2>
<p class="pankuzu"><a href="/">トップページ</a>　>　サバイバルゲーム初体験</p>
<h3>定例ゲームでサバイバルゲーム初体験！！</h3>

<p>初めて定例ゲームに参加するにあたって気をつけておくと良い。また何度かあちこちの定例ゲームに参加したあたりでついやりがちなマナー違反などについてまとめてみた。これさえ読んでおけばどこのフィールドでもOKだ！！</p>
<div class="center"><img src="/img/survival/big.jpg" width="566" height="485" /></div>

<div class="p_info" style="width:100%; margin-top:20px;">
<p>リンクがない場合は現在作成中となっております、しばらくお待ちください。</p>

</div>

<h4>準備＆実践編</h4>
<ul class="topic_list">
    <li><a href="./topic01.php">前日の夜から当日の現地到着</a></li>
    <li><a href="./topic02.php">ゲーム開始前</a></li>
    <li><a href="./topic03.php">フィールドによってルールが違うとこもある</a></li>
    <li>サバイバルゲームスタート！！</li>

</ul>
    
<h4>戦術編</h4>
<ul class="topic_list">
    <li>当たる距離・当たらない距離</li>
    <li>確率を増やす</li>
    <li>場所の有効活用で有利に</li>
    <li>縦に並ばず、横に並ぶ</li>

</ul>


<h4>テクニック編</h4>
<ul class="topic_list">
    <li>構える</li>
    <li>狙う</li>
    <li>換える</li>
    <li>攻める</li>

</ul>

<h4>ガン本体・パーツ商品一覧</h4>
<p>ガンキット・パーツがほしいならこちらから！</p>
<ul class="topic_list pages_category">
<? foreach($html->disp_category('ガン\\\\電動') as $val){?>
	<li><a href="/<?=$html->make_category_link($val["Category"]["category"])?>/page1"><?=$val["Category"]["category_name"]?></a></li>
<? }?>
</ul>