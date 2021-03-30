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
  <title>Система учета таксопарком | заказ</title>
</head>
<body>
 
  <div class="form">
    <h1>Система учета таксопарка</h1>
    <hr/>
    <?
     require_once('../DB.php');
     

     if (isset($_POST["d_taxman"])) {

      $taxman = strval($_POST['d_taxman']);
      $taxmanQuery = "SELECT * From `Taxman` WHERE Fullname='$taxman'";
      $taxmanData = $mysqli->query($taxmanQuery);
      $idTaxman;
      while ($dataTaxman = mysqli_fetch_array($taxmanData)) {
        $idTaxman = intval($dataTaxman['ID_TAXMAN']);
       } 
    

      $client = strval($_POST['d_client']);
      $clientQuery = "SELECT * from `Client` WHERE Fullname='$client'";
      $clientData = $mysqli->query($clientQuery);
      $idClient;
      while ($dataClient = mysqli_fetch_array($clientData)) {
        $idClient = intval($dataClient['ID_CLIENT']);
       } 
   

      $operator = strval($_POST['d_operator']);
      $operatorQuery = "SELECT * from `dispetcher` WHERE Fullname='$operator'";
      $operatorData = $mysqli->query($operatorQuery);
      $idOperator;
      while ($dataOperator = mysqli_fetch_array($operatorData)) {
        $idOperator = intval($dataOperator['ID_Dispetcher']);
       } 
     

      $from  = strval($_POST['d_from']);
      $to = strval($_POST['d_to']);
      $date = strval($_POST['d_date']);
      $child = strval($_POST['d_child']);

      if($child == 'Нет'){
        $child = 0;
      }else {
        $child = 1;
      }
      $bage = strval($_POST['d_bage']);
      if($bage == 'Нет'){
        $bage = 0;
      }else {
        $bage = 1;
      }

      $query = "INSERT INTO `Order` (`ID_CLIENT`, `ID_TAXMAN`, `ID_OPERATOR`, `From`, `TO`, `Date`,`Children`,`Bage`) 
      VALUES ('$idClient','$idTaxman','$idOperator','$from','$to','$date','$child','$bage')";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        echo '<p>Данные успешно добавлены в таблицу.</p>';
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };
     
       ?>
    <form action="" method="post">
    <h2>Добавить заказ</h2>

      <label for="d_client">Выбирите клиента:</label>
      <select name="d_client" id="">
      <?
       $query = "SELECT * FROM Client";
       $clients = $mysqli->query($query);
       $data;
       while($data = mysqli_fetch_array($clients)){
      ?>
      <option><?= $data['Fullname'] ?></option>
      <?
        } 
     ?>
      </select>

      <label for="d_taxman">Выбирите таксиста:</label>
      <select name="d_taxman" id="">
      <?
       $query = "SELECT * FROM Taxman";
       $taxman = $mysqli->query($query);
       $dataTaxman;
       while($dataTaxman = mysqli_fetch_array($taxman)){
      ?>
      <option><?= $dataTaxman['Fullname'] ?></option>
      <?
        }
     ?>
      </select>

      <label for="d_operator">Выбирите оператора:</label>
      <select name="d_operator" id="">
      <?
       $query = "SELECT * FROM dispetcher";
       $operator = $mysqli->query($query);
       $dataOperator;
       while($dataOperator = mysqli_fetch_array($operator)){
      ?>
      <option><?= $dataOperator['Fullname'] ?></option>
      <?
        }
        mysqli_close($mysqli);
      ?>
      </select>

      <label for="d_from">Откуда:</label>
      <input type="text" name="d_from">

      <label for="d_to">Куда:</label>
      <input type="text" name="d_to">

      <label for="d_date">Дата:</label>
      <input type="date" name="d_date">

      <label for="d_child">Дети:</label>
      <select name="d_child" id="">
        <option>Да</option>
        <option>Нет</option>
      </select>

      <label for="d_bage">Багаж:</label>
      <select name="d_bage" id="">
        <option>Да</option>
        <option>Нет</option>
      </select>

      <input type="submit" value="Добавить">
    </form>
    <a href="../orders.php"><h3>Назад</h3></a>
  </div>
</body>
</html>