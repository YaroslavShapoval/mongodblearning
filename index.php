<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>MongoDB Learning</title>
</head>
<body>

  <?php echo '<p>Hello, world!</p>'; ?>

  <?php
    //echo phpinfo();
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
  ?>

  <?php echo '<p>Bye-bye!</p>'; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>
</html>