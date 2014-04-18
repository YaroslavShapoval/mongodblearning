<!doctype html>
<html lang='ru'>
<head>
  <meta charset='UTF-8'>
  <title>MongoDB Learning</title>
  <script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
  <link rel='stylesheet' href='css/style.css'>
</head>
<body>

<?php
  # get the mongo db name out of the env
  $mongo_url = parse_url(getenv("MONGOLAB_URI"));
  $dbname = str_replace("/", "", $mongo_url["path"]);

  # connect

  echo 'i am hereeeeee!';
  $m   = new Mongo(getenv("MONGOLAB_URI"));
  $db  = $m->$dbname;
  $col = $db->access;

  # insert a document
  $visit = array( "ip" => $_SERVER["HTTP_X_FORWARDED_FOR"] );
  $col->insert($visit);

  # print all existing documents
  $data = $col->find();
  foreach($data as $visit) {
    echo "<li>" . $visit["ip"] . "</li>";
  }

  # disconnect
  $m->close();
?>

  <div class='wrapper'>
    <form action='saveform.php' method='post'>
      <div class='fields' id='dinamicForm'>
        <!-- Here will be field rows -->
      </div>

      <div class='submit-buttons'>
        <input type='submit' class='submit button' value='Отправить' />
      </div>
    </form>
  </div>

  <script src='js/fields.js'></script>
</body>
</html>