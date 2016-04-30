<?php

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN,ACCESS_TOKEN_SECRET);

$messages = array(
	"グー",
	"チョキ",
	"パー",
	);

$random = rand(0, count($messages)-1);
$params = array(
	'status' => $messages[$random].'[固定メッセージ]'
);
$result = $conn->post('statuses/update',$params);
