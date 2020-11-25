<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="#">
</head>
<body>
<table border="1">
<tr>   
	<th>Изображение </th>
	<th>Категория </th>
	<th>Заголовок  </th>
	<th>Описание  </th>
	<th>Опубликованно </th>
    <th>Контент </th>
</tr>
<form method="post">
<label>Лимит новостей </label>
		<input type = "text" placeholder="введите значение" >
		<button>Отправить</button>
</form>
<?php
require 'vendor/autoload.php';
use Carbon\Carbon;
$url  = str_replace( "&amp;", "&",  @file_get_contents("https://057.ua/rss"));
$xml = simplexml_load_string($url);
 str_replace( "&amp;", "&", $url );
$namespaces = $xml->getNamespaces(true);
$var = 0;
foreach ($xml->channel->item as $k=>$item){
$var++;
if($var == 10){
break;		 
}
$content = $item->children($namespaces["content"]);
			echo '<tr>';
			echo '<td><img src='. $item->enclosure['url'] .' width="200" height="200" ></td>';
			echo'<td>' .$item->category. '</td>';	
			echo'<td>' .$item->title.'</td>' ; 	
			echo'<td>' .$item->description. '</td>';	
			echo '<td>'.Carbon::parse($item->pubDate)-> locale('ru_RU')-> diffForHumans() .'</td>';
			echo'<td>'.  $content->encoded .'</td>';
			echo '</tr>';
		
}
?>