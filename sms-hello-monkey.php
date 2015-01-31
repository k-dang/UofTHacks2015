<?php
	include("functions.php");
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
 	$var = (String) $_REQUEST['Body'];
	// // Getting Facebook Data
	$a = get_stock_data_from_yahoo_finance_pv($var, $e);

	// if ($a != -1) {
	//     // echo "<pre>";
	//     // print_r($a);
	//     // echo "</pre>";
	// } else
	//     // echo "No stock data is available. The detail of the error is: $e";


?>
<Response>
    <Message>Hello my name is, <?php echo $a["k4"] ?></Message>
</Response>