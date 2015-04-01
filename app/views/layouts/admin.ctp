<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta http-equiv="Content-Style-Type" content="text/css" /> 
<meta http-equiv="Content-Script-Type" content="text/javascript" /> 
<meta name="description" content="札幌でラジコンを購入するならスポーツホビーへ！通販もお任せ下さい！" />
<meta name="keywords" content="ラジコン,通販,販売" />
<meta name="author" content="SportsHobby" lang="ja" xml:lang="ja" /> 
<meta name="copyright" content="COPYRIGHT(C)SportsHobby" /> 
<title>スポーツホビー管理画面</title>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.5");</script>
<?=$html->css("text");?>
<?=$html->css("admin_home");?>
</head>
<body>
<img src="/img/logo.gif" width="330" height="55" alt="ラジコンショップ｜スポーツホビー" style="vertical-align:bottom; border-bottom:1px solid #FFFFFF" />
<div id="admin_header">
	<?=$this->element("admin_header");?>
</div>
<div id="admin_body">
	<?=$content_for_layout?>
</div>
<div id="admin_foot">
	<?=$this->element("admin_foot");?>
</div>
</body>
</html>
