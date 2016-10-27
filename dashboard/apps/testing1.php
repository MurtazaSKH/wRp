<?php


$rss = new DOMDocument();

$rss->load('https://hammad:khanz89@ifarm.unfuddle.com/api/v1/projects/19/messages/935/attachments.xml');

 	$limit = 0;
	$feed = array();
	foreach ($rss->getElementsByTagName('attachment') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('filename')->item(0)->nodeValue,
			/*'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('created-at')->item(0)->nodeValue, */
			);
		array_push($feed, $item);
		$limit ++;
	}
	
	array_pop($feed);
	$limit --;
	array_pop($feed);
	$limit --;
	$feed = array_reverse($feed);
	//$limit = 10;
	
	//array_unique($input);
	
	for($x=0;$x<$limit;$x++) {
	
	$feed[$x]['title'] = str_replace('.symbols.tar.gz', '', $feed[$x]['title']);
	
	$feed[$x]['title'] = str_replace('.apk', '', $feed[$x]['title']);
	
	}
	
	$feed = array_map("unserialize", array_unique(array_map("serialize", $feed)));
	
	//array_unique($feed);
	
	for($x=0;$x<$limit;$x++) {
		$title = $feed[$x]['title'];
		
		//$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		
		//$link = $feed[$x]['link'];
		//$description = $feed[$x]['desc'];
		//$date = date('l F d, Y', strtotime($feed[$x]['date']));
		echo $title.'<br />';
		//echo '<small><em>Posted on '.$date.'</em></small></p>';
		//echo '<p>'.$description.'</p>';
	}






?>