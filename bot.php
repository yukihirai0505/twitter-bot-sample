<?php
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
$conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN,ACCESS_TOKEN_SECRET);

/* messagesの中身でランダムにつぶやくメッセージを登録しておくことができる */
$messages = array(
  "グー",
  "チョキ",
  "パー",
  );
  
$random = rand(0, count($messages)-1);

/* 固定メッセージの部分で毎回固定でつぶやきたい内容を設定することができる(ex HPのURLやハッシュタグなど */
$params = array(
    'status' => $messages[$random].'[固定メッセージ]'
  );
$result = $conn->post('statuses/update',$params);
