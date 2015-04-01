<h4>お客様情報</h4>
<table width="100%" class="contact_table" summary="お問合せフォーム">
    <tr>
        <th><span class="red">※</span>お名前</th>
        <td><?=$xformjp->text('name',array('value'=>$data["Contact"]["name"],"size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：山田　太郎</span><? }?><?=$xformjp->error('name');?></td>
    </tr>
    <tr>
        <th><span class="red">※</span>フリガナ</th>

        <td><?=$xformjp->text('kana',array('value'=>$data["Contact"]["kana"],"size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：ヤマダ　タロウ</span><? }?><?=$xformjp->error('kana');?></td>
    </tr>
    <tr>
        <th><span class="red">※</span>E-mail</th>
        <td><?=$xformjp->text('mail',array('value'=>$data["Contact"]["mail"],"size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：info@sportshobby.co.jp</span><? }?><?=$xformjp->error('mail');?></td>

    </tr>
    <tr>
        <th><span class="red">※</span>電話番号</th>
        <td><?=$xformjp->text('tell',array($data["Contact"]["tell"],"size" => 40));?>　<? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：011-773-5090</span><? }?><?=$xformjp->error('tell');?>
        <? if($xformjp->checkConfirmScreen() === false){?><span class="f10 gray" style="display:block; padding-top:3px;">※ハイフンを入れて入力してください</span><? }?></td>
    </tr>

    <tr>
        <th><span class="red">※</span>都道府県</th>
        <td><?=$xformjp->select("pref",$Pref,$data["Contact"]["pref"],array('empty'=>false,));?><?=$xformjp->error('pref');?></td>
    </tr>
    <tr>
        <th><span class="red">※</span>住所（市区町村）</th>
        <td><?=$xformjp->text('address1',array('value'=>$data["Contact"]["address1"],"size" => 50));?><?=$xformjp->error('address1');?>
        <? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：札幌市北区屯田</span><? }?></td>
    </tr>

    <tr>
        <th>住所（番地・建物名）</th>
        <td><?=$xformjp->text('address2',array('value'=>$data["Contact"]["address2"],"size" => 50));?><br />
        <? if($xformjp->checkConfirmScreen() === false){?><span class="gray">例：11条3丁目</span><? }?></td>
    </tr>
    </table>
    <h4>お問合せ内容</h4>

    <table width="100%" class="contact_table" summary="お問合せフォーム">
    <tr>
        <th><span class="red">※</span>お問合わせ種類</th>
        <td><?=$xformjp->select("category",$Category,$data["Contact"]["category"],array('empty'=>false));?><?=$xformjp->error('category');?></td>
    </tr>
    <tr>
        <th><span class="red">※</span>お問合せ内容</th>
        <td><?=$xformjp->textarea('message',array('value'=>$data["Contact"]["message"],"cols"=>50,"rows"=>5));?><?=$xformjp->error('message');?></td>

    </tr>
    </table>
    
    <h4>アンケート</h4>
    <table width="100%" class="contact_table" summary="お問合せフォーム">
    <tr>
        <th <? if($xformjp->checkConfirmScreen() === false){?>rowspan="5"<? }?>>当店（スポーツホビー）を<br />どこでお知りになりましたか？</th>
        <td><?=$xformjp->radio("enquete",$Enquete,array('legend'=>false,'separator'=>'<br />','value'=>$data["Contact"]["enquete"]));?></td>
        </tr>
    </table>