$(document).ready(function() {
  var startingCount = 2;        // Изначально есть 2 строки полей
  var currentCount = 0;         // Количество строк в данный момент
  var root = $("#dinamicForm"); // Родительский элемент для добавления

  // Вставляемый элемент
  var $node = " \
    <div class='fieldrow'> \
      <div class='field'> \
        <input type='text' class='fieldname' name='fieldname[]' placeholder='Field name' /> \
      </div> \
      <div class='field'> \
        <input type='text' class='fieldvalue' name='fieldvalue[]' placeholder='Field value' /> \
      </div> \
      <div class='field'> \
        <button type='button' class='add button'>+</button> \
        <button type='button' class='remove button'>-</button> \
      </div> \
    </div> \
  ";

  // Функция для отображения кнопок "добавить"-"удалить"
  // Кнопка "добавить" есть только в последней строке
  // Кнопка "удалить" есть в каждой строке, кроме последней
  function displayButtons() {
    $('.fieldrow .add').css('display', 'none');
    $('.fieldrow:last .add').css('display', 'inline');

    $('.fieldrow .remove').css('display', 'inline');
    $('.fieldrow:last .remove').css('display', 'none');
  }

  // Инициализация полей
  for(var i = 0; i < startingCount; i++) {
    root.after($node);
    currentCount++;
  }
  displayButtons();
  console.log(currentCount);

  // После нажатия кнопки с классом .remove.button
  // находим ближайший элемент с классом .fieldrow
  // и удаляем его
  $(document).on('click', '.remove.button', function() {
    $(this).closest('.fieldrow').remove();
    currentCount--;
    displayButtons();
    console.log(currentCount);
  });


  // После нажатия кнопки с классом .add.button
  // находим ближайший элемент с классом .fieldrow
  // и вставялем после него переменную $node
  $(document).on('click', '.add.button', function() {
    $(this).closest('.fieldrow').after($node);
    currentCount++;
    displayButtons();
    console.log(currentCount);
  });
});