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
<a href="./">Вернуться к форме</a>
<?php
  echo '<p>Привет! Список добавляемых данных таков:</p>';
  echo "<div class='field-output'";
  $field_name = $_POST['fieldname'];
  $field_value = $_POST['fieldvalue'];

  foreach ($field_name as $key => $field_name_element) {
    $field_value_element = $field_value[$key];
    echo '<p>' . $field_name_element . ': ' . $field_value_element . '</p>';
  }
  echo "</div>";

  try {
    // Если доступна переменная 'MONGOHQ_URL', то мы на heroku
    // Иначе мы на локальной машине
    if (!$mongo_url = getenv('MONGOHQ_URL')) {
      $mongo_url = 'localhost';
      $dbname = 'dinamicForm';
    }
    else {
      // Вычленяем имя базы данных из адреса сервера mongodb, полученного в переменной MONGOHQ_URL
      // MONGOHQ_URL возвращает строку вида: 'mongodb://username:password@lennon.mongohq.com:10033/app24267309'
      // в которой 'app24267309' является именем базы данных.
      // Найдём последний символ '/', а всё, что после него - искомое имя
      $dbname = substr($mongo_url, strripos($mongo_url, '/')+1);
    }

    // Подкюлаемся к серверу MongoDB
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
    echo 'ID добавленного документа: ' . $item['_id'];

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