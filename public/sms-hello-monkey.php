<?php
	header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
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

		$input = (String)$_REQUEST['Body'];
		$findme = 'Sub ';
		$pos = strpos($input,$findme);
		if($_REQUEST['Body'] == 'Stocks'){
			//$string = "stock";
			$curl = curl_init();
				// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => 'uofthackstwil.herokuapp.com/user/'.$_REQUEST['From'],
			    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			));
			// Send the request & save response to $resp
			$resp = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);
				$results = json_decode($resp);
				$string = "";
				foreach ($results as $key => $com)
				{
					$string.=$key." ".$com." | ";
				}
			$url = "http://resourceinvestingnews.com/files/the-top-5-high-volume-trading-stocks-of-the-week_1118_437849_0_14042581_500.jpg";
		}
		elseif($pos === false)
		{
			$curl = curl_init();
				// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => 'uofthackstwil.herokuapp.com/stock/'.$_REQUEST['Body'],
			    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
			));
			// Send the request & save response to $resp
			$resp = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);
				$results = json_decode($resp);
				// $string = $results;
				$string = "";
				foreach ($results as $key => $com)
				{
					$string.=$key." ".$com;
				}
			$value = $_REQUEST['Body'];

			$url = "http://chart.finance.yahoo.com/z?s=".$_REQUEST['Body']."&amp;t=6m&amp;q=l&amp;l=on&amp;z=s";

		}
		else
		{	
			$query = new ParseQuery("TestObject");
			$query->equalTo("foo", (String)$_REQUEST['From']);
			$count = $query->count();
			if (count >= 1){
				$string = "You have already subbed";
			}else{

			// save something to class TestObject
			$testObject = ParseObject::create("TestObject");
			$testObject->set("foo", (String)$_REQUEST['From']);
			$testObject->set("foo2", ltrim($input,"Sub "));

			$testObject->save();

			$string = "You have successfully subscribed!";
			# code...		}
			$url = "http://www.buzzle.com/images/cliparts/smiley-thumbs-up.jpg";
		}
		}
		

			// // get the object ID
		// echo $testObject->getObjectId();

		// echo '<h1>Users</h1>';

		// // get the first 10 users from built-in User class
		// $query = new ParseQuery("_User");
		// $query->limit(10);
		// $results = $query->find();

		// foreach ( $results as $result ) {
		//   // echo user Usernames
		//   echo $result->get('username') . '<br/>';
		// }

?>
<Response>
    <Message>
    	<Body><?php echo $string ?></Body>
    	<Media><?php echo $url ?></Media>
    </Message>
</Response>
