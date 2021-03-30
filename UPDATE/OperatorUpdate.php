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
  <title>Система учета таксопарком | редактировать оператора</title>
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

     $id = intval(str_replace('http://taxi/UPDATE/OperatorUpdate.php?id=','',$url));

     $queryOperator = $mysqli->query("SELECT * FROM `dispetcher` WHERE ID_Dispetcher=$id");
     $fullname_p;
     $passport_p;
     $adress_p;
     $date_p;
     $INN_p;
     $phone_p;
     
     while ($dataOperator = mysqli_fetch_array($queryOperator)) {
       $fullname_p =  strval($dataOperator['Fullname']);
       $passport_p =  strval($dataOperator['Passport']);
       $date_p = strval($dataOperator['Date']);
       $adress_p = strval($dataOperator['Adress']);
       $INN_p = strval($dataOperator['INN']);
       $phone_p = strval($dataOperator['Phone']);
      } 

     if (
        isset($_POST["d_fullname_e"]) 
     or isset($_POST['d_date_e'])
     or isset($_POST['d_address_e'])
     or isset($_POST['d_passport_e']) 
     or isset($_POST['d_fullname_e']) 
     or isset($_POST['d_phone_e']) 
     or isset($_POST['d_INN_e']) ) {
      if($_POST['d_date_e']){
        $date = strval($_POST['d_date_e']);
      }else {
        $date = $date_p;
      }
      if($_POST['d_address_e']){
        $addres = strval($_POST['d_address_e']);
      }else {
        $addres = $adress_p;
      }
      if($_POST['d_passport_e']){
        $passport = strval($_POST['d_passport_e']);
      }else {
        $passport = $passport_p;
      }
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
      if($_POST['d_INN_e']){
        $INN = strval($_POST['d_INN_e']);
      }else {
        $INN = $INN_p;
      }

      
     
     
      $query = "UPDATE `dispetcher` SET `Date`='$date', `Adress`='$addres',`Passport`='$passport', `Fullname`='$fullname', `Phone`='$phone', `INN`='$INN' WHERE ID_Dispetcher=$id";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        $fullname_p = $fullname;
        $phone_p = $phone;
        $passport_p = $passport;
        $adress_p = $addres;
        $INN_p = $INN;
        $date_p = $date;
        
        echo '<p>Данные успешно обновлены в таблице.</p>';
        
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };


     
       ?>
    <h2>Оператор - <?= $fullname_p ?></h2>
    <form action="" method="post">
   
    <h2>Редактировать оператора</h2>
      <label for="d_fullname_e">Полное имя:</label>
      <input type="text" name="d_fullname_e" value='<?= $fullname_p ?>'>

      <label for="d_address_e">Адрес:</label>
      <input type="text" name="d_address_e" value='<?= $adress_p ?>'>

      <label for="d_passport_e">Паспорт:</label>
      <input type="text" name="d_passport_e" value='<?= $passport_p ?>'>

      <label for="d_date_e">Дата рождения:</label>
      <input type="date" name="d_date_e" value='<?= $date_p ?>'>

      <label for="d_phone_e">Телефон:</label>
      <input type="text" name="d_phone_e" value='<?= $phone_p ?>'>

      <label for="d_INN_e">ИНН:</label>
      <input type="text" name="d_INN_e" value='<?= $INN_p ?>'>

      <input type="submit" value="Редактировать">
    </form>
    <a href="../index.php"><h3>Назад</h3></a>
  </div>
</body>
</html>