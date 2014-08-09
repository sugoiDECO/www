<?php
/*--------------------------------------------*/
/* サニタイジング */
/*--------------------------------------------*/
	function convstr($str){
	$str = mb_convert_kana($str,'KVas');
	$str = str_replace("'","’",$str);
	$str = str_replace('"','”',$str);
	$str = str_replace(";","；",$str);//大事
	$str = str_replace('&','＆',$str);
	$str = str_replace("\\","&yen;",$str);
	$str = str_replace('<','＜',$str);
	$str = str_replace('>','＞',$str);
	$str = htmlspecialchars($str,3,'UTF-8');
	$str = strip_tags($str);
	//$str = stripslashes($str);
	return $str;
}


/*--------------------------------------------*/
/* POST */
/*--------------------------------------------*/
$subject1	 = $_POST['subject1'];
$subject2	 = $_POST['subject2'];
$subject3	 = $_POST['subject3'];
$name		 = $_POST['name'];
$email		 = $_POST['email'];
$tel		 = $_POST['tel'];
$note		 = $_POST['note'];


/*--------------------------------------------*/
/* エラーチェック */
/*--------------------------------------------*/
$ng_chk = 0;

if(!$name || $name == ' ') {
	$ng_comment_name = '<b style="color:#DD0000">お名前は入力必須です</b>';
	$ng_chk ++;
} else {
	$ng_comment_name = $name;
}
if(!$email || $email == ' ') {
	$ng_comment_email = '<b style="color:#DD0000">emailは入力必須です</b>';
	$ng_chk ++;
} else {
	$EmailPattern = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
	if(!preg_match($EmailPattern, $email)){
		$ng_comment_email = '<b style="color:#DD0000">emailを正確に入力してください。</b>';
		$ng_chk ++;
	} else {
		$ng_comment_email = $email;
	}
}
if(!$tel || $tel == ' ') {
	$ng_comment_tel = '<b style="color:#DD0000">連絡先は入力必須です</b>';
	$ng_chk ++;
} else {
	$ng_comment_tel = $tel;
}


/*--------------------------------------------------*/
/* hidden */
/*--------------------------------------------------*/
$input_hidden =<<< INPUTHIDDEN
	<input type="hidden" name="subject1" value="{$subject1}" />
	<input type="hidden" name="subject2" value="{$subject2}" />
	<input type="hidden" name="subject3" value="{$subject3}" />
	<input type="hidden" name="name" value="{$name}" />
	<input type="hidden" name="email" value="{$email}" />
	<input type="hidden" name="tel" value="{$tel}" />
	<input type="hidden" name="note" value="{$note}" />\n
INPUTHIDDEN;


/*--------------------------------------------------*/
/* 表示処理 */
/*--------------------------------------------------*/
if($note) {
	$note_txt = nl2br($note);
} else {
	$note_txt = "<br />";
}


/*--------------------------------------------------*/
/* 入力エラーがある場合 */
/*--------------------------------------------------*/
if ($ng_chk !== 0){
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE HTML>
<html lang="ja-JP">

<!-- headはここから --> 
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
<meta charset="UTF-8">
<meta name="keywords" content="　" />
<meta name="description" content="　" />
<title>お問い合わせ｜すごい災害訓練DECO</title>
<link href="../css/default.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/contents.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../js/page-scroll.js"></script>
<script type="text/javascript" src="../js/jquery.tile.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$('#ul_index01 li').tile(3);
	$('#ul_member01 li').tile(3);
	$('#ul_movie01 li').tile(2);
});
</script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<!-- headはここまで --> 
<!-- bodyはここから --> 
<body id="contact">
<div id="headerWrap">
  <div id="header" class="clearfix">
    <h1><a href="../index.html"><img src="../images/common/h1_logo.gif" alt="すごい災害訓練DECO"/></a></h1>
    <ul>
      <li><a href="https://www.facebook.com/sugoideco" target="_blank"><img src="../images/common/btn_facebook.gif" alt="facebook"/></a></li>
      <li><a href="https://twitter.com/hashtag/%E3%81%99%E3%81%94%E3%81%84%E7%81%BD%E5%AE%B3%E5%AF%BE%E5%BF%9C%E8%A8%93%E7%B7%B4%E3%83%AA%E3%83%8F" target="_blank"><img src="../images/common/btn_twitter.gif" alt="Twitter"/></a></li>
      <li><a href="../contact/index.html"><img src="../images/common/btn_contact.gif" alt="お問い合わせ"/></a></li>
    </ul>
  </div>
</div>
<!--/headerWrap-->
<div id="gnavi">
  <ul class="clearfix">
    <li id="gnavi01"><a href="../index.html">ホーム</a></li>
    <li id="gnavi02"><a href="../principle/index.html">基本理念</a></li>
    <li id="gnavi03"><a href="index.html">メンバー紹介</a></li>
    <li id="gnavi04"><a href="../project/index.html#">プロジェクト</a></li>
    <li id="gnavi05"><a href="../movie/index.html">DECOムービー</a></li>
  </ul>
</div>
<!--/gnavi-->
<div id="container" class="clearfix">
  <div id="contents">
<h2>お問い合わせ　~内容確認~</h2>
<p class="contactSubttl"><img src="../images/contact/mail2.png" width="730" height="45" alt="お問い合わせステップ2" /></p>
<p><spam class="fr">入力内容に誤りがあります。</span><br />前画面に戻って正しく入力してください。</p>
<table class="mainTb">
<tr>
<th>お名前</th>
<td><?php print $ng_comment_name; ?></td>
</tr>
<tr>
<th>連絡先メールアドレス</th>
<td><?php print $ng_comment_email; ?></td>
</tr>
<tr>
<th>連絡先電話番号</th>
<td><?php print $ng_comment_tel; ?><br />
例）03-1234-5678</td>
</tr>
<tr>
<th>問い合わせ内容</th>
<td><?php print $note_txt; ?></td>
</tr>
</table>
<p class="contactBtn">
    <a href="javascript:history.back()">  
        <img src="../images/contact/mail_btn3.png" alt="前の画面に戻る">  
    </a> 
</p>
<!-- メールフォームはここまで -->
  </div>
  <!--/contents-->
<!-- サイドナビはここから -->
  <div id="side">
    <div class="widget">
      <h3>キャンプ一覧</h3>
      <ul>
        <li><a href="../project/project_a01.html">浦安キャンプ</a></li>
      </ul>
    </div>
    <div class="widget">
      <h3>DECOムービー</h3>
      <ul>
        <li><a href="../movie/index.html">2014年</a></li>
      </ul>
    </div>
    <div class="widget">
      <h3>メンバー</h3>
      <ul>
        <li><a href="../member/member01.html">田口空一郎</a></li>
        <li><a href="../member/member02.html">古橋大地</a></li>
        <li><a href="../member/member03.html">田村賢哉</a></li>
        <li><a href="../member/member04.html">増山茂</a></li>
        <li><a href="../member/member05.html">千島 康稔</a></li>
      </ul>
    </div>
  </div>
  <!--/side--> 
</div>
<!--/container-->
<div id="pagetop"><a href="#headerWrap"><img src="../images/common/btn_pagetop01.gif" alt="ページトップに戻る"/></a></div>
<!--/pagetop-->
<div id="footer">
  <ul>
    <li><a href="../index.html">HOME</a></li>
    <li><a href="../principle/index.html">基本理念</a></li>
    <li><a href="index.html">メンバー紹介</a></li>
    <li><a href="../project/index.html">プロジェクト</a></li>
    <li><a href="../movie/index.html">DECOムービー</a></li>
    <li><a href="../principle/index.html#cooperation">構成団体</a></li>
    <li><a href="../contact/index.html">お問い合わせ</a></li>
    <!-- <li><a href="../sitemap/index.html">サイトマップ</a></li>
    <li><a href="../privacy/index.html">プライバシーポリシー</a></li> -->
  </ul>
  <p>Copyright © DECO All Rights Reserved.</p>
</div>
<!--/footer-->
</body>
</html>
<?php
return;
}




?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<!DOCTYPE HTML>
<html lang="ja-JP">

<!-- headはここから --> 
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
<meta charset="UTF-8">
<meta name="keywords" content="　" />
<meta name="description" content="　" />
<title>お問い合わせ｜すごい災害訓練DECO</title>
<link href="../css/default.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="../css/contents.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../js/page-scroll.js"></script>
<script type="text/javascript" src="../js/jquery.tile.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
	$('#ul_index01 li').tile(3);
	$('#ul_member01 li').tile(3);
	$('#ul_movie01 li').tile(2);
});
</script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<!-- headはここまで --> 

<!-- bodyはここから --> 
<body id="contact">
<div id="headerWrap">
  <div id="header" class="clearfix">
    <h1><a href="../index.html"><img src="../images/common/h1_logo.gif" alt="すごい災害訓練DECO"/></a></h1>
    <ul>
      <li><a href="https://www.facebook.com/sugoideco" target="_blank"><img src="../images/common/btn_facebook.gif" alt="facebook"/></a></li>
      <li><a href="https://twitter.com/hashtag/%E3%81%99%E3%81%94%E3%81%84%E7%81%BD%E5%AE%B3%E5%AF%BE%E5%BF%9C%E8%A8%93%E7%B7%B4%E3%83%AA%E3%83%8F" target="_blank"><img src="../images/common/btn_twitter.gif" alt="Twitter"/></a></li>
      <li><a href="../contact/index.html"><img src="../images/common/btn_contact.gif" alt="お問い合わせ"/></a></li>
    </ul>
  </div>
</div>
<!--/headerWrap-->
<div id="gnavi">
  <ul class="clearfix">
    <li id="gnavi01"><a href="../index.html">ホーム</a></li>
    <li id="gnavi02"><a href="../principle/index.html">基本理念</a></li>
    <li id="gnavi03"><a href="index.html">メンバー紹介</a></li>
    <li id="gnavi04"><a href="../project/index.html#">プロジェクト</a></li>
    <li id="gnavi05"><a href="../movie/index.html">DECOムービー</a></li>
  </ul>
</div>
<!--/gnavi-->
<div id="container" class="clearfix">
  <div id="contents">
<h2>お問い合わせ　~フォームに記入~</h2>
<p class="contactSubttl"><img src="../images/contact/mail1.png" width="730" height="45" alt="お問い合わせステップ1" /></p>
<p>- 以下の内容でよろしければ送信ボタンを押して下さい -</p>
 
<form action="send.php" method="POST">
<input type="hidden" name="mode" value="send">
<table class="mainTb">
<tr>
<th>お名前</th>
<td><?php print $name; ?></td>
</tr>
<tr>
<th>連絡先メールアドレス</th>
<td><?php print $email; ?></td>
</tr>
<tr>
<th>連絡先電話番号</th>
<td><?php print $tel; ?><br />
例）03-1234-5678</td>
</tr>
<tr>
<th>問い合わせ内容</th>
<td><?php print $note_txt; ?></td>
</tr>
</table>
<p>
<?php print $input_hidden; ?>
<p class="contactBtn"><input type="image" src="../images/contact/mail_btn2.png" alt="送信する" onClick="history.back()"></p>
</form>
<!-- メールフォームはここまで -->
  </div>
  <!--/contents-->
<!-- サイドナビはここから -->
  <div id="side">
    <div class="widget">
      <h3>キャンプ一覧</h3>
      <ul>
        <li><a href="../project/project_a01.html">浦安キャンプ</a></li>
      </ul>
    </div>
    <div class="widget">
      <h3>DECOムービー</h3>
      <ul>
        <li><a href="../movie/index.html">2014年</a></li>
      </ul>
    </div>
    <div class="widget">
      <h3>メンバー</h3>
      <ul>
        <li><a href="../member/member01.html">田口空一郎</a></li>
        <li><a href="../member/member02.html">古橋大地</a></li>
        <li><a href="../member/member03.html">田村賢哉</a></li>
        <li><a href="../member/member04.html">増山茂</a></li>
        <li><a href="../member/member05.html">千島 康稔</a></li>
      </ul>
    </div>
  </div>
  <!--/side--> 
</div>
<!--/container-->
<div id="pagetop"><a href="#headerWrap"><img src="../images/common/btn_pagetop01.gif" alt="ページトップに戻る"/></a></div>
<!--/pagetop-->
<div id="footer">
  <ul>
    <li><a href="../index.html">HOME</a></li>
    <li><a href="../principle/index.html">基本理念</a></li>
    <li><a href="index.html">メンバー紹介</a></li>
    <li><a href="../project/index.html">プロジェクト</a></li>
    <li><a href="../movie/index.html">DECOムービー</a></li>
    <li><a href="../principle/index.html#cooperation">構成団体</a></li>
    <li><a href="../contact/index.html">お問い合わせ</a></li>
    <!-- <li><a href="../sitemap/index.html">サイトマップ</a></li>
    <li><a href="../privacy/index.html">プライバシーポリシー</a></li> -->
  </ul>
  <p>Copyright © DECO All Rights Reserved.</p>
</div>
<!--/footer-->
</body>
</html>