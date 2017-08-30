# twitter_bot

Twitterのdeveloper画面でアプリを作成

[https://apps.twitter.com/](https://apps.twitter.com/)

PHPでTwitterBotのサンプルを作成(勉強会用)

まずは記録しておいた

- Consumer Key (API Key)
- Consumer Secret (API Secret)  
- Access Token
- Access Token Secret

をconfig.phpに記述していきます。

```config.php


<?php
define('CONSUMER_KEY', '');
define('CONSUMER_SECRET', '');
define('ACCESS_TOKEN', '');
define('ACCESS_TOKEN_SECRET', '');

```

これでBot自体は既に動く状態になります。
つぶやきたいメッセージなどはbot.phpで設定することができます。

```
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
```
  
あとはbot.phpを実行すればAPIを通じてTwitterに投稿することができるようになります。
  
```
php bot.php
```
