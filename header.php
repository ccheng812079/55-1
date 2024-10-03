<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>快樂旅遊網</title>
<?php include 'link.php';?>
</head>
<style>



 label{
 display: block;
 }
 #burger:checked + ul{
 display:block;
 }
 #burger {
            display: none; 
        }
        ul {
          display: none;
          list-style: none;
            right: 0;
        
        }
        
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-success ">
&ensp;&ensp;<h2><a class="text-white"  href="message.php">快樂旅遊網</a></h2>&ensp;&ensp;&ensp;&ensp;
<h4 ><a class="text-white" href="message.php">訪客留言</a>&ensp;
<a class="text-white" href="home.php">訪客訂房</a>&ensp;
<a class="text-white" href="food.php">訪客訂餐</a>&ensp;
<a class="text-white" href="adminweb.php">網站管理</a>
</h4> </nav>



<h2>
<div class="d-grid gap-2 d-md-flex justify-content-md-end" >
<label for="burger" class="">☰</label>
<input type="checkbox" id="burger">
<ul>
 <li><a href="message.php">訪客留言</a></li>
 <li><a href="home.php">訪客訂房</a></li>
 <li><a href="food.php">訪客訂餐</a></li>
 <li><a href="adminweb.php">網站管理</a></li>
</ul></div></h2>
<p></p>

 

</body>
</html>