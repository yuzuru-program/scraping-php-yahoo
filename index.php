<?php

require_once './phpQuery-onefile.php';

function my_curl($url)
{
  $cp = curl_init();

  /*オプション:リダイレクトされたらリダイレクト先のページを取得する*/
  curl_setopt($cp, CURLOPT_RETURNTRANSFER, 1);

  /*オプション:URLを指定する*/
  curl_setopt($cp, CURLOPT_URL, $url);

  /*オプション:タイムアウト時間を指定する*/
  curl_setopt($cp, CURLOPT_TIMEOUT, 30);

  /*オプション:ユーザーエージェントを指定する*/
  curl_setopt($cp, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36');

  $data = curl_exec($cp);

  curl_close($cp);

  return $data;
}

$url = 'https://www.yahoo.co.jp';
$doc = phpQuery::newDocument(my_curl($url));

$ul = $doc->find('main article section')->find("ul:eq(0)");

for ($i = 0; $i < count($ul->find("li")); ++$i) {
  $li = $ul->find("li:eq($i)");
  echo  $li[0]->text();
  echo "\n";
  echo $li[0]->find("a")->attr('href').PHP_EOL;
  echo "\n";
}
?>
