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
  echo '<p>Hello!</p>';
  $field_name = $_POST['fieldname'];
  $field_value = $_POST['fieldvalue'];

  foreach ($field_name as $key => $field_name_element) {
    $field_value_element = $field_value[$key];
    echo '<p>' . $field_name_element . ': ' . $field_value_element . '</p>';
  }

  //try {
    // Подкюлаемся к серверу MongoDB
    echo "<p>i'm inside try/catch</p>";
    //$MONGOHQ_URL = "mongodb://heroku:m5Hr0c7KdcvAkDjkRv_MqbTKKXe2IfH966RR8EJ9nMWhalKHoSKwcnHuIJ3tdZ3xEkhQwT-2DExMPdTTyaJZQQ@lennon.mongohq.com:10026/app24267309";
    //$mongohq = getenv('MONGOHQ_URL');

    if (!$mongo_url = getenv('MONGOHQ_URL')) {
      $mongo_url = 'localhost';
    }
    else {
      echo "<p>i'm on heroku! my url is: $mongo_url</p>";
    }
    //$mongo_url = getenv('MONGOHQ_URL') ?: die('Missing MONGOHQ_URL environment variable');
    $username = 'yaroslav';
    $password = 'admin3465';
    $mongo = new MongoClient($mongo_url, array("username" => $username, "password" => $password));

    echo "<p>connection established</p>";
/*
    // Выбираем БД
    $dbname = 'dinamicForm';
    $db = $mongo->selectDB($dbname);
    echo "<p>db selected</p>";

    // Выбираем коллекцию
    $collection = $db->fields;

    // Подготавливаем документ, соединяя поля
    $item = array();
    foreach ($field_name as $key => $field_name_element) {
      $field_value_element = $field_value[$key];
      $item["$field_name_element"] = "$field_value_element";
    }

    // Добавляем новый документ
    $collection->insert($item);
    echo 'Inserted document with ID: ' . $item['_id'];

    // Отключаемся от сервера
    $mongo->close();
  } catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
  } catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
  };*/
  //phpinfo();
?>

</div>
</body>
</html>