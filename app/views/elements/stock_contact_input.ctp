<h4>商品情報</h4>
<table width="100%" class="contact_table" summary="商品情報">
<tr>
    <th>商品ID</th>
    <td><?=$Item["Item"]["rac"]?></td>
</tr>
<tr>
    <th>商品名</th>
    <td><?=$Item["Item"]["item_name"]?></td>
</tr>
<tr>
    <th>価格</th>
    <td><?=$Item["Item"]["sell_price"]?></td>
</tr>
</table>

<h4>お客様情報</h4>
<table width="100%" class="contact_table" summary="お問合せフォーム">
    <tr>
        <th><span class="red">※</span>お名前</th>
        <td><?=$xformjp->text('name',array("size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：山田　太郎</span><? }?><?=$xformjp->error('name');?></td>
    </tr>
    <tr>
        <th><span class="red">※</span>フリガナ</th>

        <td><?=$xformjp->text('kana',array("size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：ヤマダ　タロウ</span><? }?><?=$xformjp->error('kana');?></td>
    </tr>
    <tr>
        <th><span class="red">※</span>E-mail</th>
        <td><?=$xformjp->text('mail',array("size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：info@sportshobby.co.jp</span><? }?><?=$xformjp->error('mail');?></td>

    </tr>
    <tr>
        <th>電話番号</th>
        <td><?=$xformjp->text('tell',array("size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：011-773-5090</span><? }?>
        <? if($xformjp->checkConfirmScreen() === false){?><span class="f10 gray" style="display:block; padding-top:3px;">※ハイフンを入れて入力してください</span><? }?></td>
    </tr>

    <tr>
        <th>都道府県</th>
        <td><?=$xformjp->select("pref",$Pref,null,array('empty'=>"--------",));?></td>
    </tr>
    <tr>
        <th>住所（市区町村）</th>
        <td><?=$xformjp->text('address1',array("size" => 50));?>
        <? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：札幌市北区屯田</span><? }?></td>
    </tr>

    <tr>
        <th>住所（番地・建物名）</th>
        <td><?=$xformjp->text('address2',array('value'=>$data["StockContact"]["address2"],"size" => 50));?><br />
        <? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：11条3丁目</span><? }?></td>
    </tr>
	<tr>
		<th>お問合せ内容</th>
		<td><?=$xformjp->textarea('message',array('value'=>$data["StockContact"]["message"],"cols"=>50,"rows"=>5));?></td>
	</tr>
</table>


<h4>アンケート</h4>
<table width="100%" class="contact_table" summary="お問合せフォーム">
<tr>
    <th <? if($xformjp->checkConfirmScreen() === false){?>rowspan="5"<? }?>>当店（スポーツホビー）を<br />どこでお知りになりましたか？</th>
    <td><?=$xformjp->radio("enquete",$Enquete,array('legend'=>false,'separator'=>'<br />','value'=>$data["StockContact"]["enquete"]));?></td>
    </tr>
</table>