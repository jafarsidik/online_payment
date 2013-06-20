<?php

error_reporting(E_ALL);

function die_with_error($error) {
  $ret = array(
    "status" => "Failed",
    "error" => $error
  );
  die(json_encode($ret));
}


if (!isset($_GET["bound"]) || !isset($_GET['buyer'])
    || !isset($_GET['st']) || !isset($_GET['et']))
  die_with_error("invalid parameters");

$bound = $_GET["bound"];
$buyer = $_GET['buyer'];
$st = $_GET['st'];
$et = $_GET['et'];

switch ($bound) {
case '0':
  $lower_bound = 0;
  $upper_bound = 50;
  break;

case '1':
  $lower_bound = 50;
  $upper_bound = 100;
  break;

case '2':
  $lower_bound = 100;
  $upper_bound = 200;
  break;

case '3':
  $lower_bound = 200;
  $upper_bound = 500;
  break;

case '4':
  $lower_bound = 500;
  $upper_bound = 1000;
  break;

case '5':
  $lower_bound = 1000;
  $upper_bound = 10000;
  break;

case '6':
  $lower_bound = 10000;
  break;

default:
  break;
}

$hostname = '222.205.48.145';
$username = 'test';
$password = 'test';
$dbname = 'easypay';

mysql_connect($hostname, $username, $password) or die_with_error(mysql_error());
mysql_select_db($dbname) or die_with_error(mysql_error());
mysql_set_charset('utf8');

if ($upper_bound) {
  $query = "select * from ordered where Buyer_id like '%" . $buyer ."%' and Final_price >= " . $lower_bound . " and Final_price <=" . $upper_bound;
} else {
  $query = "select * from ordered where Buyer_id like '%" . $buyer ."%' and Final_price >= " . $lower_bound;
}

if ($st) {
  $query = $query . " and order_date >= '" . $st . "'";
}
if ($et) {
  $query = $query . " and order_date <= '" . $et . "'";
}

$result = mysql_query($query. " ;");

if (! $result)
  die_with_error(mysql_error());

$result_array = array();
while ($row = mysql_fetch_assoc($result)) {

  array_push($result_array,
             array(

               "order_id" => $row['order_id'],
               "order_date" => $row['order_date'],
               "order_type" => $row['Type'],
               "goods_id" => $row['Goods_id'],
               "status" => $row['Status'],
               "single_price" => $row['Single_price'],
               "final_price" => $row['Final_price'],
               "discount" => $row['Discount'],
               "amount" => $row['Amount'],
               'buyer_id' => $row['Buyer_id'],
               "address" => $row['Address'],
               "seller_id" => $row['Seller_id']
             ));
}


$ret = array(
  "status" => "OK",
  "data" => $result_array
);
die(json_encode($ret));
?>