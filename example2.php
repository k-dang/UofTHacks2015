<?php
 
include("functions.php");
 
// Getting Facebook Data
$a = get_stock_data_from_yahoo_finance_pv("", $e);

if ($a != -1) {
    echo "<pre>";
    print_r($a);
    echo "</pre>";
} else
    echo "No stock data is available. The detail of the error is: $e";

    ?>