<? 
$this->layout="no_action";
$this->set('title', 'お問い合わせ');
$this->set('h1', 'お気軽にお問い合わせください！');
$this->set('keywords', "お問い合わせ,ラジコン");
$this->set('description', "札幌でラジコン(RC)を購入するなら在庫量日本一のスポーツホビーでショッピング！！");
?>

<h2 class="pages">お問い合わせフォーム</h2>
<p class="pankuzu"><a href="/">トップページ</a>　>　お問い合わせ</p>
<h3>スポーツホビーへのお問い合わせはこちらから</h3>
<p>商品のお問い合わせやスポーツホビーの店舗に対するお問合せは下記フォームから送信してください。</p>
<p><span class="red">※</span>マークは必須項目です。</p>


<?=$xformjp->create('Contact', array('type'=>'post',)); ?>
<?=$this->element('contact_input'); ?>
<div align="center" style="padding-top:30px;"><?=$xformjp->submit('　　確認　　',array('name'=>'confirm', 'div'=>false));?></div>
<?=$xformjp->end();?>