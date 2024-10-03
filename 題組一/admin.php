<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網</title>
    <?php include 'link.php';?>
</head>
<body>    <?php include 'header.php';?>
    
<div class="container mt-5 pt-3">
    <?php $pos=$_GET['pos']??'m';?>
<div class="border p-3 text-center ">
<a class="btn  <?php echo $pos=='m'?'btn-primary':'btn-light'?>"href="?pos=m">留言管理</a>
<a class="btn <?php echo $pos=='room'?'btn-primary':'btn-light'?>" href="?pos=room">訂房管理</a>
<?php include "admin$pos.php";?>