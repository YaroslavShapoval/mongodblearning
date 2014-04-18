<!doctype html>
<html lang='ru'>
<head>
  <meta charset='UTF-8'>
  <title>MongoDB Learning</title>
  <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
  <link rel='stylesheet' href='css/style.css'>
</head>
<body>
<div class='wrapper'>
<a href="./">Back home</a>
<?php
echo 'hello!';
  $field_name = $_POST['fieldname'];
  $field_value = $_POST['fieldvalue'];

  foreach( $field_name as $key => $field_name_element ) {
    echo '<p>' . $field_name_element . ': ' . $field_value[$key] . '</p>';
  }
?>

  <?php
    //echo phpinfo();
/*
  try {
   // open connection to MongoDB server
   $conn = new Mongo('localhost');

   // access database
   $db = $conn->test;

   // access collection
   $collection = $db->items;

   // execute query
   // retrieve all documents
   $cursor = $collection->find();

   // iterate through the result set
   // print each document
   echo $cursor->count() . ' document(s) found. <br/>';
   foreach ($cursor as $obj) {
    echo 'Name: ' . $obj['name'] . '<br/>';
    echo 'Quantity: ' . $obj['quantity'] . '<br/>';
    echo 'Price: ' . $obj['price'] . '<br/>';
    echo '<br/>';
   }

   // disconnect from server
   $conn->close();
  } catch (MongoConnectionException $e) {
   die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
   die('Error: ' . $e->getMessage());
  }
*/
  ?>

</div>
</body>
</html>