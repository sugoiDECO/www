<?php
mb_language("Japanese");
mb_internal_encoding ("UTF-8");

/*--------------------------------------------*/
/* POST */
/*--------------------------------------------*/
$name		 = $_POST['name'];
$email		 = $_POST['email'];
$tel		 = $_POST['tel'];
$note		 = $_POST['note'];


/*--------------------------------------------*/
/* SEND MAIL */
/*--------------------------------------------*/
if($_POST['mode'] == 'send') {

/*--------------------------------------------*/
/* SEND MAIL */
/*--------------------------------------------*/
$send_mail = "${email}";		//=======送り先1
$ml_title = "お問い合わせ頂きありがとうございます";
$row_mail = 'hayashi@re-creation.co.jp';		//----------リターンパス(Return-path)
$x_mailer = "PHP_FORM_MAIL";
$sasidasinin = "hayashi@re-creation.co.jp";		//------------差出人.
$replyto = "hayashi@re-creation.co.jp";

$from_title = mb_encode_mimeheader('すごい災害訓練DECO','iso-2022-jp');

$from_tx = "From: "."${from_title}<".$sasidasinin. ">\n";
$from_tx .= "Reply-To: "."${replyto}"."\n";
$from_tx .= "X-Mailer: ".$x_mailer."\n";
$from_tx .= "Content-Type: text/plain; charset=iso-2022-jp\n";
$from_tx .= "Content-Transfer-Encoding: 7bit\n";


$sendmail_msg =<<<MESSAGE
この度は、お問い合わせいただき、誠にありがとうございます。

詳細につきましては、弊社より改めてご連絡申し上げますの
で、よろしくお願いいたします。

氏名:
{$name}

メールアドレス:
{$email}

ご連絡可能なお電話番号:
{$tel}

備考内容・メッセージ:
{$note}


このメールはシステムより自動的に返信しております。
なお、当メールにお心あたりのない方やご質問のある方は、
お手数ですが、下記連絡先までご連絡ください。
※このメールは返信専用のアドレスで配信しておりますので、
このメールに返信されてもご回答できませんので、ご了承ください。

株式会社サイウッドではお客さまの個人情報を適切に保護するため、
お答えいただいた内容につきましては、記載の目的以外には流用いたしません。
………………………………………………………………………………………………
すごい災害訓練　DECO
担当：田口

MESSAGE;
//--------------------------------------
$kekka1 = mb_send_mail($send_mail, $ml_title, $sendmail_msg, $from_tx,"-f${row_mail}");
$send_mail2 = 'hayashi@re-creation.co.jp';
$bcc1 = mb_send_mail($send_mail2, $ml_title, $sendmail_msg, $from_tx,"-f${row_mail}");

} else {
	echo "送信エラー";
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
<h2>お問い合わせ　~お問い合わせ完了~</h2>
<p class="contactSubttl"><img src="../images/contact/mail3.png" width="730" height="45" alt="お問い合わせステップ3" /></p>

<p class="clear_center">お問い合わせありがとうございました。<br />
メール確認後、ご連絡させて頂きます。</p>
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
