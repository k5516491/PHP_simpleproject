<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</style>
</head>
<body>
<!--NavBar-->
<?php if (auth()->loggedIn()): ?> 
<h2>你好，<?= auth()->user()->first_name ?></h2>
<?php endif; ?>
<nav>
  <a href="<?= url_to("/") ?>" >首頁</a>
  <?php if (auth()->loggedIn()): ?>
    <?php if (auth()->user()->inGroup("admin")): ?>
        <a href="<?= url_to("admin/user") ?>" >使用者</a>
    <?php endif; ?>
    
    <a href="<?= url_to("logout") ?>" >登出</a>
  <?php else: ?>
      <a href="<?= url_to("login") ?>" >點擊登入</a>
  <?php endif; ?>
</nav>  
<!--End of NavBar-->
<?php 
    if (session()->has("fail")) 
    {
        echo session("fail");
    }   
 ?>
 <!--沒有權限訪問-->
<?php if (session()->has("error")): ?>

    <?= "沒有權限訪問此頁面" ?>
<?php endif; ?>
<!--沒有權限訪問-->
<?php 
    if (session() -> get("errors")!=null) 
    {
      $s = session()->get("errors");
        echo $s[0] ;
        session() ->set("errors",null);
    }   
 ?>

<?= $this->renderSection("content"); ?>

<div class="footer">
  <p></p>
</div>



</body>
</html>
