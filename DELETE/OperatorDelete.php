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

     $id = intval(str_replace('http://taxi/DELETE/OperatorDelete.php?id=','',$url));

     $queryOperator = $mysqli->query("SELECT * FROM `dispetcher` WHERE ID_Dispetcher=$id");
     $fullname_p;
    
     
     while ($dataOperator = mysqli_fetch_array($queryOperator)) {
       $fullname_p =  strval($dataOperator['Fullname']);
      
      } 

     if ($_POST['delete']) {
      $query = "DELETE from `dispetcher` WHERE ID_Dispetcher=$id";
      $sql = mysqli_query($mysqli,$query);
      if ($sql) {
        echo '<p>Данные успешно удалены в таблице.</p>';
        echo '<a href="../index.php">К операторам</a>';
        mysqli_close($mysqli);
        exit;
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($mysqli) . '</p>';
      }
     };
       ?> 
    <form action="" method="post">
    <h2>Вы уверены что хотите удалить оператора - <?= $fullname_p ?></h2>
      <input type="submit" value="Да" name="delete">
      <a href="../index.php"><input type="button" value="Нет"></a>
    </form>
  
  </div>
</body>
</html>