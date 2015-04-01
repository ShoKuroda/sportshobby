<? 
$this->layout="no_action";
$this->set('title', $Item["Item"]["item_name"].'の在庫の問い合わせ');
$this->set('h1', $Item["Item"]["item_name"].'の在庫確認');
$this->set('keywords', "在庫,お問い合わせ,ラジコン");
$this->set('description', "札幌でラジコン(RC)を購入するなら在庫量日本一のスポーツホビーでショッピング！！");
?>

<h2 class="pages"><?=$Item["Item"]["item_name"]?>の在庫の問い合わせフォーム</h2>
<p class="pankuzu"><a href="/">トップページ</a>　>　在庫の問い合わせ</p>
<h3>在庫の問い合わせはこちらから</h3>
<p>下記フォームより送信してください。</p>
<p><span class="red">※</span>マークは必須項目です。</p>


<?=$xformjp->create('StockContact', array('type'=>'post','url'=>'/contacts/stock_contact?id='.str_replace(RAKUTEN_SHOPID,"",$Item["Item"]["rac"]))); ?>
<?=$this->element('stock_contact_input'); ?>
<div align="center" style="padding-top:30px;"><?=$xformjp->submit('　　確認　　',array('name'=>'confirm', 'div'=>false));?></div>
<?=$xformjp->end();?>