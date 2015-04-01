<? 
$this->layout="no_action";
$this->set('title', '新着情報');
$this->set('h1', 'スポーツホビー新着情報');
$this->set('keywords', "新着情報,ラジコン");
$this->set('description', "スポーツホビーからのお知らせ");
?>
<script type="text/javascript" src="/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.lightbox-0.5.css">
<script type="text/javascript">  
$(function() {  
  $('.gallery').lightBox();  
});  
</script>  
<h2 class="pages">スポーツホビーからのお知らせ</h2>
<p class="pankuzu"><a href="/">トップページ</a>　>　新着情報</p>
<h3>お得な情報をチェック</h3>

<?=$paginator->counter(array('format' => __('%page% / %pages% ページ,  全%count%件中%current%件, ( %start% から %end%）', true)));?>
<div class="pagination">
    <ul>
        <li class="prev"><?=($paginator->params["paging"]["UsedInfo"]["prevPage"])?(str_replace("page:","",$paginator->prev('<<前へ'))):("");?></li>
        <?=str_replace("page:","",$paginator->numbers(array('separator' => '　','tag'=>"li")));?>
        <li class="next"><?=($paginator->params["paging"]["UsedInfo"]["nextPage"])?(str_replace("page:","",$paginator->next('次へ>>'))):("");?></li>
    </ul>
</div>

<? foreach($UsedInfo as $val){?>
<a name="<?=$val["UsedInfo"]["id"]?>"></a>
<h4><?=$val["UsedInfo"]["title"]?> <span class="bg_category_cm bg_category_<?=$val["UsedInfo"]["category"]?>" style="font-weight:normal;"><?=$Category[$val["UsedInfo"]["category"]]?></span></h4>
<? if($val["UsedInfo"]["img1"]){?>
    <a href="/img/used_info/<?=$val["UsedInfo"]["img1"]?>" class="gallery">
    <img src="/img/used_info/sam_<?=$val["UsedInfo"]["img1"]?>" align="right" class="img_border new_info_img" alt="<?=$val["UsedInfo"]["title"]?>" /></a>
<? }?>

<p><?=nl2br($val["UsedInfo"]["text"])?></p>
<? }?>