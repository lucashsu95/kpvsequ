<?php
include('../link.php');
$sql = $db->prepare('insert into repair(class,repair_name,repair_place,situation,repair_date,processing) values(:class,:repair_name,:repair_place,:situation,:repair_date,:processing)');
$sql->bindValue('class',$_POST['class']);
$sql->bindValue('repair_name',$_POST['repair_name']);
$sql->bindValue('repair_place',$_POST['repair_place']);
$sql->bindValue('situation',$_POST['situation']);
$sql->bindValue('repair_date',$date);
$sql->bindValue('processing','未處理');
$sql->execute();
echo '<script>alert("報修成功"),location.href="../index.php"</script>';
#header('location:.././');