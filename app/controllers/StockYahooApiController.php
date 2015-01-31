<?php

class StockYahooApiController extends \BaseController {


	public function getStockPrice($ids) {
		// return $ids;

		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quote%20where%20symbol%20in%20(%22YHOO%22%2C%22AAPL%22%2C%22GOOG%22%2C%22MSFT%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys',
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);

		$results = json_decode($resp);

		$companyArray = $results->query->results->quote;
		$pricesArray = array();

		// $i = 0;
		foreach ($companyArray as $company) {
			$pricesArray[$company->Symbol] = $company->LastTradePriceOnly;
			// $i++;
		}
		
		return Response::json($pricesArray);
	}


}
