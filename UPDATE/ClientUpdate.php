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
  <title>Система учета таксопарком | редактировать клиента</title>
</head>
<body>
 
  <div class="form">
    <h1>Система учета таксопарка</h1>
    <hr/>
    <?
     require_once('../DB.php');
     $url = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '') . '://';
     $url = $url . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
     define('URL', $url);

     $id = intval(str_replace('http://taxi/UPDATE/ClientUpdate.php?id=','',$url));

     $queryClient = $mysqli->query("SELECT * FROM `Client` WHERE ID_CLIENT=$id");
     $fullname_p;
     $phone_p;
     
     while ($dataClient = mysqli_fetch_array($queryClient)) {
       $fullname_p =  strval($dataClient['Fullname']);
       $phone_p = strval($dataClient['Phone']);
      } 

     if (
        isset($_POST["d_fullname_e"]) 
     or isset($_POST['d_phone_e']) ) {
     
      if($_POST['d_fullname_e']){
        $fullname  = strval($_POST['d_fullname_e']);
      }else {
        $fullname = $fullname_p;
      }
      if($_POST['d_phone_e']){
        $phone = strval($_POST['d_phone_e']);
      }else {
        $phone = $phone_p;
      }
     
      $query = "UPDATE `Client` SET `Fullname`='$fullname', `Phone`='$phone' WHERE ID_CLIENT=$id";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        $fullname_p = $fullname;
        $phone_p = $phone;
        
        echo '<p>Данные успешно обновлены в таблице.</p>';
        
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };


     
       ?>
    <h2>Клиент - <?= $fullname_p ?></h2>
    <form action="" method="post">
   
    <h2>Редактировать клиента</h2>
      <label for="d_fullname_e">Полное имя:</label>
      <input type="text" name="d_fullname_e" value='<?= $fullname_p ?>'>

     
      <label for="d_phone_e">Телефон:</label>
      <input type="text" name="d_phone_e" value='<?= $phone_p ?>'>

      <input type="submit" value="Редактировать">
    </form>
    <a href="../clients.php"><h3>Назад</h3></a>
  </div>
</body>
</html>