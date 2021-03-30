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
  <title>Система учета таксопарком | редактировать таксиста</title>
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

     $id = intval(str_replace('http://taxi/UPDATE/CarUpdate.php?id=','',$url));

     $queryCar = $mysqli->query("SELECT * FROM `Car` WHERE ID_CAR=$id");
     $model_p;
     $number_p;
     $Taxman_p;
     
     
     while ($dataCar = mysqli_fetch_array($queryCar)) {
       $model_p =  strval($dataCar['Model']);
       $number_p =  strval($dataCar['Number']);
       $Taxman_p = intval($dataCar['ID_TAXMAN']);
      } 
      
      $queryTaxman = $mysqli->query("SELECT * FROM `Taxman` WHERE ID_TAXMAN='$Taxman_p'");
      $idTax;
      $fullnameTaxman;
     while ($dataTaxman = mysqli_fetch_array($queryTaxman)) {
      $idTax =  strval($dataTaxman['ID_TAXMAN']);
      $fullnameTaxman = $dataTaxman['Fullname'];
     } 
     if (
        isset($_POST["d_model"]) 
     or isset($_POST['d_number'])) {
      if($_POST['d_model']){
        $model = strval($_POST['d_model']);
      }else {
        $model = $model_p;
      }
      if($_POST['d_number']){
        $number = strval($_POST['d_number']);
      }else {
        $number = $number_p;
      }
     
     
      $query = "UPDATE `Car` SET `Number`='$number', `Model`='$model',`ID_TAXMAN`='$Taxman_p' WHERE ID_CAR=$id";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        $number_p = $number;
        $model_p = $model;
      
        echo '<p>Данные успешно обновлены в таблице.</p>';
        
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };


     
       ?>
    <h2>Таксист - <?= $fullnameTaxman ?></h2>
    <form action="" method="post">
    <h2>Добавить автомобиль таксиста</h2>
      <label for="d_model">Модель:</label>
      <input type="text" name="d_model" value='<?= $model_p ?>'>

      <label for="d_number">Номер:</label>
      <input type="text" name="d_number" value='<?= $number_p ?>'>
    

      <input type="submit" value="Редактировать">
    </form>
    <a href="../taxmans.php"><h3>Назад</h3></a>
  </div>
</body>
</html>