<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta http-equiv="Content-Style-Type" content="text/css" /> 
<meta http-equiv="Content-Script-Type" content="text/javascript" /> 
<meta name="description" content="<?=(isset($keywords))?($keywords):(SITE_KEYW)?>" />
<meta name="keywords" content="<?=(isset($description))?($description):(SITE_DESCRI)?>" />
<meta name="author" content="SportsHobby" lang="ja" xml:lang="ja" /> 
<meta name="copyright" content="COPYRIGHT(C)SportsHobby" /> 
<title><?=(isset($title))?($title." - "):("")?><?=SITE_TITLE?></title>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.4");</script>
<script type="text/javascript" src="/js/side_menu.js"></script>
<script type="text/javascript" src="/js/jquery.ajaxSuggest.1.5.1.js"></script>
<link rel="stylesheet" type="text/css" href="/css/home.css" />
<link rel="stylesheet" type="text/css" href="/css/text.css" />
<link rel="stylesheet" type="text/css" href="/css/bx_styles/bx_styles.css" />
<link rel="stylesheet" type="text/css" href="/css/jquery.ajaxSuggest.css">
<link rel="stylesheet" type="text/css" href="/css/pages.css" />
</head>
<body>
<div id="header">
<?=$this->element('header');?>
</div><!--header-->

<div id="pages_main">
	<?=$content_for_layout?>
</div><!--main-->


<div id="topic_box" class="pages_topic_box">
<?=$this->element("topic");?>
</div><!--topic_box-->


<?=$this->element('foot');?>

</body>
</html>
