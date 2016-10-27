
<?php

define('JIRA_URL', 'https://jira.pocketgems.com');
define('USERNAME', 'hammad');
define('PASSWORD', 'khanz89');

function post_to($resource, $data) {
	$jdata = json_encode($data);
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_POST => 1,
		CURLOPT_URL => JIRA_URL . '/rest/api/latest/' . $resource,
		CURLOPT_USERPWD => USERNAME . ':' . PASSWORD,
		CURLOPT_POSTFIELDS => $jdata,
		CURLOPT_HTTPHEADER => array('Content-type: application/json'),
		CURLOPT_RETURNTRANSFER => true
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return json_decode($result);
}

function create_issue($issue) {
	return post_to('issue', $issue);
}

$new_issue = array(
	'fields' => array(
		'project' => array('key' => 'CLI'),
		'summary' => 'Test via REST',
		'description' => 'Description of issue goes here.',
		//'component' => 'DCON Issues',
		'issuetype' => array('name' => 'Story')
	)
);

$result = create_issue($new_issue);
if (property_exists($result, 'errors')) {
	echo "Error(s) creating issue:\n";
	var_dump($result);
} else {
	echo "New issue created at " . JIRA_URL ."/browse/{$result->key}\n";
}

?>