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
    //$hostname = 'localhost';
    $hostname = getenv("MONGOHQ_URL");
    $mongo = new Mongo($hostname);

    // Выбираем БД
    $dbname = 'dinamicForm';
    $db = $mongo->selectDB($dbname);

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
  }
?>

</div>
</body>
</html>