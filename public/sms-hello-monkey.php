<?php
	
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$curl = curl_init();
		// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => 'uofthackstwil.herokuapp.com/stock/1',
	    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);

	$results = json_decode($resp);

	$string = "";
	foreach ($results as $key => $com){
		$string.=$key." ".$com."|";
	}

	//echo $resp;
?>
<Response>
    <Message><?php echo $string ?></Message>
</Response>