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
  $string = "mongodb://username:password@lennon.mongohq.com:10033/app24267309";
  echo strripos($string, '/');
  echo '<p> DB name: \''.substr($string, strripos($string, '/')+1).'\'</p>';
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