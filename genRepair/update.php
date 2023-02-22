<?php
include('../link.php');
switch($_GET['do']){
    case 'processing':
        $sql = $db->prepare("update genrepair set processing=:processing,process_time=:process_time where id=:id");
        $sql->bindValue('processing',$_POST['processing']);
        $sql->bindValue('process_time',$date);
        break;
    case 'process_content':
        $sql = $db->prepare("update genrepair set process_content=:process_content where id=:id");
        $sql->bindValue('process_content',$_POST['process_content']);
        // $sql->bindValue('id',$_POST['id']);
        // $sql->execute();
        break;
}
$sql->bindValue('id',$_POST['id']);
$sql->execute();
header('location:genrepairlist.php');