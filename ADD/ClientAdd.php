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
  <title>Система учета таксопарком | добавить клиента</title>
</head>
<body>
 
  <div class="form">
    <h1>Система учета таксопарка</h1>
    <hr/>
    <?
     require_once('../DB.php');
     

     if (isset($_POST["d_fullname"])) {
      $fullname_d = strval($_POST['d_fullname']);
      $phone_d = strval($_POST['d_phone']);
     
     
      $query = "INSERT INTO `Client` (`Fullname`, `Phone`) VALUES ('$fullname_d','$phone_d')";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        echo '<p>Данные успешно добавлены в таблицу.</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };
     
       ?>
    <form action="" method="post">
    <h2>Добавить клиента</h2>
      <label for="d_fullname">Полное имя:</label>
      <input type="text" name="d_fullname">

      <label for="d_phone">Телефон:</label>
      <input type="text" name="d_phone">

      <input type="submit" value="Добавить">
    </form>
    <a href="../clients.php"><h3>Назад</h3></a>
  </div>
</body>
</html>