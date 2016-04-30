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

/* messagesの配列で用意した数からランダムで一つ取り出す */
$random = rand(0, count($messages)-1);

/* 固定メッセージの部分で毎回固定でつぶやきたい内容を設定することができる(ex HPのURLやハッシュタグなど */
$params = array(
    'status' => $messages[$random].'[固定メッセージ]'
  );
/*
post($url, $parameters = array()) 第一引数にURLのPATHを渡し、第二引数にパラメーターを渡す
今回はこちらを使用
https://dev.twitter.com/rest/reference/post/statuses/update
他のURLも試してみる??
下記を参照
https://dev.twitter.com/rest/public
*/

/* 自分のタイムラインにツイート */
$result = $conn->post('statuses/update',$params);

if($result->text) {
  echo "【" . $result->text . "】とTwitterに投稿しました。";
} else if(sizeof($result->errors) > 0) {
  /*
   * error message: Status is a duplicate. は同じ投稿を何回も繰り返すと返ってくるエラー
   * error message: Bad Authentication data. はconfig.phpの内容が間違っている可能性大
   */
  $errors = $result->errors;
  foreach ($errors as $error) {
    echo "error message: " . $error->message;
  }
} else {
  echo "何か不測の事態が発生しているようだ。チャレンジングなことをしているようだな。おれには手に負えないぜ。そんな時は下記のvar_dumpでデバックしてみよう。";
}

// デバッグしたいときは下記のコメントを外す
// var_dump($result);


/*
自分のタイムラインを取得
今回はこちらを使用
https://dev.twitter.com/rest/reference/get/statuses/user_timeline
*/
/*
$tweets = $conn->get('statuses/user_timeline', null);
foreach($tweets as $index=>$tweet) {
  echo $index+1 . "個目のツイート:" . $tweet->text . "<br />";
}

// デバッグしたいときは下記のコメントを外す
// var_dump($tweets);
*/