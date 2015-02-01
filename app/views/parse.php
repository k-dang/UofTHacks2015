<?php

// define location of Parse PHP SDK, e.g. location in "Parse" folder
// Defaults to ./Parse/ folder. Add trailing slash
define( 'PARSE_SDK_DIR', './Parse/' );

// include Parse SDK autoloader
require_once( '../vendor/autoload.php' );

// Add the "use" declarations where you'll be using the classes
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;

// Init parse: app_id, rest_key, master_key
// ParseClient::initialize('xxx', 'yyy', 'zzz');
ParseClient::initialize('xqzKtcoFExd5PfOuaYgxMJRd2X6BaZu2asTr66QS', '9anpllqCv2sR1v3AgukRwWiBxDkVGnDzX5PPMGpF', '5iSGiI2WrdqmQ1XXUUzfVHZUMemE9cEE3WEE93LN');

// save something to class TestObject
$testObject = ParseObject::create("User");
$testObject->set("foo", "bar");
$testObject->save();

// get the object ID
// echo $testObject->getObjectId();

echo '<h1>Users</h1>';
$query = new ParseQuery("TestObject");
		$query->limit(10);
		$results = $query->find();
		foreach ( $results as $result ) {
		  // echo user Usernames
		  $val =  "'" . $result->get("foo2", "+19059735762") . "',";
		  echo $val;
		}

// // get the first 10 users from built-in User class
// $query = new ParseQuery("TestObject");
// $query->limit(10);
// $results = $query->find();

// foreach ( $results as $result ) {
//   // echo user Usernames
//   echo $result->get('foo') . '<br/>';
//   echo $result->get('foo2') . '<br/>';
// }