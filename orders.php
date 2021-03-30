<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
    include('styles.php');
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Система учета таксопарком | заказы</title>
</head>
<body>
<?php
    include('navigation.php');
  ?>
   <div class="content">
    <h1>Система учета таксопарка</h1>
    <h2>Заказы</h2>
    <hr/>
    <table border="1px" cellspacing="2px" cellpadding="3px">
      <caption><h2>Таблица заказов:</h2></caption>
      <tr>
        <th>Клиент</th>
        <th>Таксист</th>
        <th>Оператор</th>
        <th>Откуда</th>
        <th>Куда</th>
        <th>Дата</th>
        <th>Дети</th>
        <th>Багаж</th>
        <th>Действия</th>
      </tr>
    
     <?
     require_once('DB.php');
     $query = "SELECT * FROM `Order`";
     $orders = $mysqli->query($query);
     $data;
     while($data = mysqli_fetch_array($orders)){
      #Client 
      $id_client = $data['ID_CLIENT'];
      $queryClient = $mysqli->query("SELECT * FROM `Client` WHERE ID_CLIENT=$id_client");
      $ClietFullname;
      while ($dataClient = mysqli_fetch_array($queryClient)) {
        $ClietFullname = $dataClient['Fullname'];
       }
       
      #Operator
      $id_Operator = $data['ID_OPERATOR'];
      $queryOperator = $mysqli->query("SELECT * FROM `dispetcher` WHERE ID_Dispetcher=$id_Operator");
      $ClietFullname;
      while ($dataOperator = mysqli_fetch_array($queryOperator)) {
        $OperatorFullname = $dataOperator['Fullname'];
       } 

      #Taxman
      $id_Taxman = $data['ID_TAXMAN'];
      $queryTaxman = $mysqli->query("SELECT * FROM `Taxman` WHERE ID_TAXMAN=$id_Taxman");
      $ClietFullname;
      while ($dataTaxman = mysqli_fetch_array($queryTaxman)) {
        $TaxmanFullname = $dataTaxman['Fullname'];
       } 
      //  child and bage
       $child;
       $bage;

       if($data['Children']==1){
         $child = 'Да';
       }else {
         $child = 'Нет';
       };
       if($data['Bage']==1){
        $bage = 'Да';
      }else {
        $bage = 'Нет';
      };
       ?>
       <tr>
        <td><?= $ClietFullname ?></td>
        <td><?= $TaxmanFullname ?></td>
        <td><?= $OperatorFullname ?></td>
        <td><?= $data['From']?></td>
        <td><?= $data['TO']?></td>
        <td><?= $data['Date']?></td>
        <td><?= $child ?></td>
        <td><?= $bage ?></td>
        <td>
          <a href="UPDATE/OrderUpdate.php?id=<?php echo $data['ID_ORDER'];?>">Редактировать</a>
          <a href="DELETE/OrderDelete.php?id=<?php echo $data['ID_ORDER'];?>">Удалить</a>
        </td>

    </tr> 
     
     <?
     }
     mysqli_close($mysqli);
     ?>
    </table>
    <a href="ADD/OrderAdd.php"><h3>Добавить новый заказ...</h3></a>
  </div>
</body>
</html>