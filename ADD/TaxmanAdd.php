<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel='stylesheet' href='../styles.css'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система учета таксопарком | таксисты</title>
</head>
<body>
 
  <div class="form">
    <h1>Система учета таксопарка</h1>
    <hr/>
    <?
     require_once('../DB.php');
     

     if (isset($_POST["d_fullname"])) {
      $date = strval($_POST['d_date']);
      $addres = strval($_POST['d_address']);
      $driver = strval($_POST['d_driver']);
      $fullname  = strval($_POST['d_fullname']);
      $phone = strval($_POST['d_phone']);
      $INN = strval($_POST['d_INN']);
     
      $query = "INSERT INTO `Taxman` (`Date`, `adress`, `Driver`, `Fullname`, `Phone`, `INN`) VALUES ('$date','$addres','$driver','$fullname','$phone','$INN')";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        echo '<p>Данные успешно добавлены в таблицу.</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };
     
       ?>
    <form action="" method="post">
    <h2>Добавить таксиста</h2>
      <label for="d_fullname">Полное имя:</label>
      <input type="text" name="d_fullname">

      <label for="d_address">Адрес:</label>
      <input type="text" name="d_address">

      <label for="d_date">Дата рождения:</label>
      <input type="date" name="d_date">

      <label for="d_driver">Водительское удостоверение:</label>
      <input type="text" name="d_driver">

      <label for="d_phone">Телефон:</label>
      <input type="text" name="d_phone">

      <label for="d_INN">ИНН:</label>
      <input type="text" name="d_INN">

      <input type="submit" value="Добавить">
    </form>
    <a href="../taxmans.php"><h3>Назад</h3></a>
  </div>
</body>
</html>