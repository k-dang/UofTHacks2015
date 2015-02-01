<?php
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
class StockYahooApiController extends \BaseController {


	public function getStockPrice($ids) {
		// return $ids;
		$name = $ids;
		// return $name;
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    //CURLOPT_URL => 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quote%20where%20symbol%20in%20(%22YHOO%22%2C%22AAPL%22%2C%22GOOG%22%2C%22MSFT%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys',
		   	CURLOPT_URL => 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quote%20where%20symbol%20in%20('.$name.')&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys',

		    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		//return Response::json($resp);
		// Close request to clear up some resources
		curl_close($curl);

		$results = json_decode($resp);
		return $results;
		$companyArray = $results->query->results->quote->Symbol;
		$companyPrice = $results->query->results->quote->LastTradePriceOnly;
		// $resp = $companyArray . " " . " " . $companyPrice;
		return Response::json([$companyArray=>$companyPrice]);


		// $pricesArray = array();

		// // $i = 0;
		// foreach ($companyArray as $company) {
		// 	$pricesArray[$company->Symbol] = $company->LastTradePriceOnly;
		// 	return Response::json($pricesArray);

		// 	// $i++;
		// }
	}

	public function getSubs($phoneNum){
		//get the stocks
		//getStockPrice(stocks)

		// get the first 10 users from built-in User class
		// return $phoneNum;
		$query = new ParseQuery("TestObject");
		$query->limit(10);
		$results = $query->find();
		$val = "";
		foreach ( $results as $result ) {
		  // echo user Usernames
			$val .=  "'" . $result->get("foo2", (String)$phoneNum) . "',";

		}
		$name = rtrim($val,",");

		// return $name;
		$curl = curl_init();

		// $temp ='https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quote%20where%20symbol%20in%20('.$name.')&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys';
		// return $temp;
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    //CURLOPT_URL => 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quote%20where%20symbol%20in%20(%22YHOO%22%2C%22AAPL%22%2C%22GOOG%22%2C%22MSFT%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys',
		   	CURLOPT_URL => 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quote%20where%20symbol%20in%20('.$name.')&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys',

		    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));

		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// return $resp;
		//return Response::json($resp);
		// Close request to clear up some resources
		curl_close($curl);

		$results = json_decode($resp);
		// return $results;


		$stockNames = $results->query->results->quote;
		$pricesArray = array();

		foreach ($stockNames as $stockName) {
				$pricesArray[$stockName->Symbol] = $stockName->LastTradePriceOnly;
		}

		return $pricesArray;

		// $companyArray = $results->query->results->quote->Symbol;
		// return $companyArray;
		// $companyPrice = $results->query->results->quote->LastTradePriceOnly;

		// $pricesArray = array();

		// // $i = 0;
		// foreach ($companyArray as $company) {
		// 	$pricesArray[$company->Symbol] = $company->LastTradePriceOnly;
		// 	// return Response::json($pricesArray);

		// 	//== $i++;
		// }

		// $resp = $companyArray . " " . " " . $companyPrice;
		// return Response::json([$companyArray]);
	}



}
