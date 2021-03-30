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

     $id = intval(str_replace('http://taxi/UPDATE/OrderUpdate.php?id=','',$url));

     $queryOrder = $mysqli->query("SELECT * FROM `Order` WHERE ID_ORDER=$id");
      $client_p;
      $taxman_p;
      $dispetcher_p;
      $form_p;
      $to_p;
      $date_p;
      $children_p;
      $bage_p;
      
      $client;
      $operator;
      $taxman;
      $date;
      $to;
      $from;
      $bage;
      $child;
     
     while ($dataOrder = mysqli_fetch_array($queryOrder)) {
      $client_p = strval($dataOrder['ID_CLIENT']);
      $taxman_p = intval($dataOrder['ID_TAXMAN']);
      $dispetcher_p = intval($dataOrder['ID_OPERATOR']);
      $form_p = strval($dataOrder['From']);
      $to_p = strval($dataOrder['TO']);
      $date_p = strval($dataOrder['Date']);
      $children_p = strval($dataOrder['Children']);
      $bage_p = strval($dataOrder['Bage']);
      } 

      if($children_p == 0){
        $children_p = "Нет";
      }else {
        $children_p = "Да";
      }

      if($bage_p == 0){
        $bage_p = "Нет";
      }else {
        $bage_p = "Да";
      }

      $queryClient = $mysqli->query("SELECT * FROM `Client` WHERE ID_CLIENT='$client_p'");
      $client_name_p;
      while ($dataClient_p = mysqli_fetch_array($queryClient)) {
        $client_name_p =  strval($dataClient_p['Fullname']);

       } 
      $queryTaxman = $mysqli->query("SELECT * FROM `Taxman` WHERE ID_TAXMAN='$taxman_p'");
      $taxman_name_p;
      while ($dataTaxman_p = mysqli_fetch_array($queryTaxman)) {
         $taxman_name_p =  strval($dataTaxman_p['Fullname']);
      }  
      $queryOperator = $mysqli->query("SELECT * FROM `dispetcher` WHERE ID_Dispetcher='$dispetcher_p'");
      $operator_name_p;
      while ($dataOperator_p = mysqli_fetch_array($queryOperator)) {
           $operator_name_p =  strval($dataOperator_p['Fullname']);
      }  
       
     if (
        isset($_POST["d_client"]) 
     or isset($_POST['d_taxman'])
     or isset($_POST['d_operator'])
     or isset($_POST['d_from'])
     or isset($_POST['d_to'])
     or isset($_POST['d_date'])
     or isset($_POST['d_child'])
     or isset($_POST['d_bage']) ) {
     
      if($_POST['d_client']){
        $client  = strval($_POST['d_client']);
        $clientQuery = "SELECT * from `Client` WHERE Fullname='$client'";
        $clientData = $mysqli->query($clientQuery);
        $idClient;
        while ($dataClient = mysqli_fetch_array($clientData)) {
          $idClient = intval($dataClient['ID_CLIENT']);
         } 
      }else {
        $client = $client_p;
      }
      if($_POST['d_taxman']){
        $taxman = strval($_POST['d_taxman']);
        $taxmanQuery = "SELECT * From `Taxman` WHERE Fullname='$taxman'";
        $taxmanData = $mysqli->query($taxmanQuery);
        $idTaxman;
        while ($dataTaxman = mysqli_fetch_array($taxmanData)) {
          $idTaxman = intval($dataTaxman['ID_TAXMAN']);
         } 
      }else {
        $taxman = $taxman_p;
      }
      if($_POST['d_operator']){
        $operator = strval($_POST['d_operator']);
        $operatorQuery = "SELECT * from `dispetcher` WHERE Fullname='$operator'";
        $operatorData = $mysqli->query($operatorQuery);
        $idOperator;
        while ($dataOperator = mysqli_fetch_array($operatorData)) {
          $idOperator = intval($dataOperator['ID_Dispetcher']);
         } 
      }else {
        $operator = $dispetcher_p;
      }
      if($_POST['d_from']){
        $from = strval($_POST['d_from']);
      }else {
        $from = $form_p;
      }
      if($_POST['d_to']){
        $to = strval($_POST['d_to']);
      }else {
        $to = $to_p;
      }
      if($_POST['d_date']){
        $date = strval($_POST['d_date']);
      }else {
        $date = $date_p;
      }
      if($_POST['d_child']){
        $child = strval($_POST['d_child']);
        if($child == 'Нет'){
          $child = 0;
        }else {
          $child = 1;
        }
      }else {
        $child = $children_p;
      }
      if($_POST['d_bage']){
        $bage = strval($_POST['d_bage']);
        if($bage == 'Нет'){
          $bage = 0;
        }else {
          $bage = 1;
        }
      }else {
        $bage = $bage_p;
      }
     
      $query = "UPDATE `Order` SET `ID_CLIENT`='$idClient', `ID_TAXMAN`='$idTaxman',`ID_OPERATOR`='$idOperator',`From`='$from',`TO`='$to',`Date`='$date',`Children`='$child',`Bage`='$bage' WHERE ID_ORDER=$id";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        $$client_name_p = $client;
        $taxman_name_p = $taxman;
        $operator_name_p= $operator;
        $form_p = $from;
        $to_p = $to;
        $date_p = $date;
        $children_p = $child;
        $bage_p = $bage;
        
        echo '<p>Данные успешно обновлены в таблице.</p>';
        
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };


     
       ?>

    <form action="" method="post">
    <h2>Редактировать заказ</h2>
    <hr>
      <p>Клиент - <?= $client_name_p ?></p>
      <hr>
      <label for="d_client">Выбирите другого клиента:</label>
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
      <hr>
      <p>Таксист - <?= $taxman_name_p ?></p>
      <hr>
      <label for="d_taxman">Выбирите другого таксиста:</label>
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
      <hr>
      <p>Оператор - <?= $operator_name_p ?></p>
      <hr>
      <label for="d_operator">Выбирите другого оператора:</label>
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
      <input type="text" name="d_from" value='<?= $form_p ?>' >

      <label for="d_to">Куда:</label>
      <input type="text" name="d_to" value='<?= $to_p ?>'>

      <label for="d_date">Дата:</label>
      <input type="date" name="d_date" value='<?= $date_p ?>'>
      <hr>
      <p>Дети - <?= $children_p ?></p>
      <hr>
      <label for="d_child">Выберите другое значение:</label>
      
      <select name="d_child" id="">
        <option>Да</option>
        <option>Нет</option>
      </select>
      <hr>
      <p>Багаж - <?= $children_p ?></p>
      <hr>
      <label for="d_bage">Выберите другое значение:</label>
      <select name="d_bage" id="">
        <option>Да</option>
        <option>Нет</option>
      </select>

      <input type="submit" value="Редактировать">
    </form>
    <a href="../orders.php"><h3>Назад</h3></a>
  </div>
</body>
</html>