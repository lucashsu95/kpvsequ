<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>穀保-教學設備維修填報系統</title>
    <link rel="shortcut icon" href="../img/LOGO.jpg" type="image/x-icon">
  <link rel="stylesheet" href="../css/index.css">
  <style>
    button{
      margin:30px auto;
    }
    footer{
      position: relative;
    }
  </style>
</head>
<body>
  <?php 
  include('../back.php');
  include('../link.php');

  // @$num = $_GET['num'] > 10 ? $_GET['num'] : 10;
  // @$page = $num - 10;
  @$num = $_GET['num'] >= 10 ? $_GET['num'] : 0;
  $sql = "select * from repair";
  if(@$_GET['key'] <> '' || @$_SESSION['user'] === 'repair'){
    $sql .= ' where processing="未處理"';
  }
  $sql .= " order by id desc limit $num,10";
  $query = $db->query($sql)->fetchAll();
  $line = count($db->query('select * from repair')->fetchAll());
  
  ?>
  <a href="repairlist.php?key=未處理" class="backBtn">未處理</a>
  <div class="table">
    
    <div class="tr">
      <div>報修類別</div>
      <div>填報人</div>
      <div>損壞地點</div>
      <div>處理進度</div>
      <div>填報時間</div>
    </div>
    <?php foreach($query as $data){ ?>
      <div class="tr">
        <div><?php echo $data['class'] ?></div>
        <div><?php echo $data['repair_name'] ?></div>
        <div><?php echo $data['repair_place'] ?></div>
        <?php if(@$_SESSION['user'] === 'repair'){ ?>
          <form action="update.php?do=processing" method="post" id='processing<?php echo $data['id']?>'>
            <select name="processing" onchange='document.getElementById("processing<?php echo $data["id"]?>").submit()'>
              <option value="已處理" <?php if($data['processing'] === '已處理') echo "selected" ?> style='background-color:#20c997;'>已處理</option>
              <option value="未處理" <?php if($data['processing'] !== '已處理') echo "selected" ?> style='background-color:#dc3545;'>未處理</option>
            </select>
            <input type="hidden" name="id" value='<?php echo $data['id'] ?>'>
          </form>
            <?php }else{ ?>
              <div <?php echo $data['processing'] === "已處理" ? "style='color:#20c997'" : "style='color:#dc3545'" ?>><?php echo $data['processing'] ?></div>
            <?php } ?>
        <div class='date'><?php echo $data['repair_date'] ?></div>
      </div>
      <section class='information'>
        <div>
            <div>狀況概述</div>
            <div>處理概述</div>
            <div>處理時間</div>
        </div>
        <div>
            <div><?php echo $data['situation']?></div>
            
            <div>
              <?php if(@$_SESSION['user'] === 'repair'){ ?>
                <form action='update.php?do=process_content' method='post'>
                  <input type='text' name='process_content' value='<?php echo $data['process_content']?>' placeholder='可填處理概述'>
                  <input type="hidden" name="id" value="<?php echo $data['id']?>">
                </form>
              <?php }else{ ?>
                <?php echo $data['process_content']?>
              <?php } ?>
            </div>
            <div><?php echo $data['process_time']?></div>
        </div>
      </section>
    <?php } ?>
  </div>
  <section class='select_page'>
    <article>
        記錄第<?php echo $num+1 .'-'. (($num + 10 > $line) ? $line:$num+10)  ?>筆，共<?php echo $line ?>筆
      </article>
      <article>
        <?php if($num > 10){ ?>
          <a href='repairlist.php?num=0'>第一頁</a>
          <a href='repairlist.php?num=<?php echo $num - 10 ?>'>上一頁</a>
          <?php }else{ ?>
            <div></div>
            <div></div>
            <?php }
              ?>
              <a href='repairlist.php?num=<?php echo $num + 10 ?>'>下一頁</a>
              <a href='repairlist.php?num=<?php echo $line - ($line % 10) ?>'>最後一頁</a>
            </article>
          </section>
          <section>
            <?php if(@$_SESSION['user'] === 'repair'){ ?>
              <a href="../login/logout.php">登出</a>
              <a href="../downloadExcel.php">前往下載excel</a>
              <?php }else{ ?>
                <a href="../login/login.html">登入</a>
              <?php } ?>
          </section>
  <?php include('../footer.php'); ?>
</body>
</html>