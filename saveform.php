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

  try {
    // Подкюлаемся к серверу MongoDB
    echo "<p>i'm inside try/catch</p>";

    if (!$mongo_url = getenv('MONGOHQ_URL')) {
      $mongo_url = 'localhost';
      $dbname = 'dinamicForm';
    }
    else {
      //$mongo_url = "mongodb://$username:$password@lennon.mongohq.com:10033/app24267309";
      //$mongo_url = "mongodb://$username:$password@lennon.mongohq.com:10033";
      //$mongo_url_new = "mongodb://$username:$password" . substr($mongo_url, strpos('@'));
      //$dbname = str_replace("/", "", $mongo_url["path"]);
      $dbname = substr($mongo_url, strripos($mongo_url, '/')+1);
      echo '<p>DB name: ' . $dbname . '</p>' ;
    }

    $mongo = new MongoClient($mongo_url);

    // Выбираем БД
    $db = $mongo->$dbname;

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
  };
?>

</div>
</body>
</html>