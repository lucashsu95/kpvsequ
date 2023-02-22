<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel下載資料</title>
    <link rel="shortcut icon" href="img/LOGO.jpg" type="image/x-icon">
</head>
<body>
    <?php
    include('link.php');
    
    if(isset($_SESSION['user'])){

        if($_SESSION['user']=== 'repair'){
            $key = 'repair';
        }elseif($_SESSION['user']=== 'genrepair'){
            $key = 'genrepair';
        }
    ?>
        <form action="xls.php" method="post" style='marign:0 auto;text-align:center'>
            <a href="./" class='backBtn'>回系統首頁</a>
            <h1>Excel下載資料</h1>
            <h3>選擇日期範圍</h3>
        <p>
            <input type="date" name="dateStart" value='<?php echo date('Y-m-d') ?>'>
            ~
            <input type="date" name="dateEnd" value='<?php echo date('Y-m-d',strtotime('+1 day')) ?>'>
        </p>
            <input type="submit" value="下載">
            <input type="hidden" name="key" value='<?php echo $key ?>'>
        </form>
    
    
    <?php
        }else{
            header('location:./');
        }
    ?>
</body>
</html>