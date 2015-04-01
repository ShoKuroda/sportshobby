<? 
$this->layout="no_action";
$this->set('title', 'ラジコンドリフト特集');
$this->set('h1', 'ドリフト特集');
$this->set('keywords', "ドリフト,ラジコン");
$this->set('description', "フルにカウンターを当て続けながら走行するドリフトスタイル！！");
?>

<h2 class="pages">R/Cリアルドリフト特集</h2>
<p class="pankuzu"><a href="/">トップページ</a>　>　ラジコンドリフト特集</p>
<h3>今日から君もクローリングしよう！！</h3>
<div class="center"><img src="/img/drift/big.gif" width="566" height="533" /></div>
<p>ドリフトユーザーたちの間で、今もっとも話題になっているのが「リアルドリフト」！<br />
これは、フルにカウンターを当て続けながら走行するドリフトスタイルを意味します。今までのドリフトのワンステップ上のテクニックか…と思いきや、これが難しい！！そこで誰でも最初の一歩を踏み出せる特集をお届けします。</p>

<h4>リアルドリフトの秘密</h4>
<ul class="topic_list">
    <li><a href="/drift/topic01">フルにカウンターを当て続けること！！</a></li>
    <li><a href="/drift/topic02">リアルドリフト一問一答　問1～問4</a></li>
    <li><a href="/drift/topic03">リアルドリフト一問一答　問5～問9</a></li>
    <li><a href="/drift/topic04">これをやらねば始まらない！！4つの鉄板法則</a></li>
</ul>


<h4>ドライビングテクニック編</h4>
<ul class="topic_list">
    <li>スピンしない発進の仕方</li>
    <li>まっすぐ走る方法</li>
    <li>カウンターを当てる方法</li>
    <li>飛距離と角度の調節</li>
    <li>次のコーナーへのアプローチ</li>
</ul>

<h4>ドリフトパッケージの商品</h4>
<p>ドリフトキット・パーツがほしいならこちらから！</p>
<ul class="topic_list pages_category">
<? foreach($html->disp_category('ラジコンカー\\\\電動カー\\\\RCドリフト') as $val){?>
	<li><a href="/<?=$html->make_category_link($val["Category"]["category"])?>/"><?=$val["Category"]["category_name"]?></a></li>
<? }?>
</ul>