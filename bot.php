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
$result = $conn->post('statuses/update',$params);

if($result->text) {
  echo "【" . $result->text . "】とTwitterに投稿しました。";
} else if(sizeof($result->errors) > 0) {
  /* error message: Status is a duplicate. となっているときは同じ投稿を何回も繰り返すと返ってくるエラー */
  $errors = $result->errors;
  foreach ($errors as $error) {
    echo "error message: " . $error->message;
  }
} else {
  echo "何か不測の事態が発生しているようだ。おれには手に負えないぜ";
}

/* デバッグしたいときは下記のコメントを外す */
// var_dump($result);
