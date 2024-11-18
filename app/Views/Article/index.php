<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>所有文章</title>
<!--------------------------------------------------->
<!--AddSuccess Section-->
<?php 
    if (session() -> get("success")!=null) 
    {
        /*$id = session()->get("NewestID"); 
        echo "編號:".$id. "號文章新增成功!!<br>" ;*/
        echo "文章新增成功!!<br>" ;
        session() ->set("success",null);
    }   
 ?>
<!--------------------------------------------------->
<!--UpdateSuccess Section-->
<?php 
    if (session() -> get("UpdateSuccess")!=null) 
    {
        $id = session()->get("UpdateSuccess"); 
        echo "編號".$id. "號文章修改成功!!<br>" ;
        session() ->set("UpdateSuccess",null);
    }   
 ?>
 <!--------------------------------------------------->
<!--DeleteSuccess Section-->
<?php 
    if (session() -> get("DeleteSuccess")!=null) 
    {
        $id = session()->get("DeleteSuccess"); 
        echo "編號".$id. "號文章刪除成功!!<br>" ;
        session() ->set("DeleteSuccess",null);
    }   
 ?>
  <!--------------------------------------------------->
<!--ChangePWSuccess Section-->
<?php 
    if (auth()->loggedIn())
        $user=auth()->user()->first_name;
    else $user= "";
    if (session() -> get("ChangePWSuccess")!=null) 
    {
        //$id = session()->get("DeleteSuccess"); 
        echo "使用者 "."$user"."修改密碼成功，請於下次登入使用新密碼" ;
        session() ->set("ChangePWSuccess",null);
    }   
 ?>
<!--------------------------------------------------->
<!--Login、out-->
<?php if (auth()->loggedIn()): ?>
    <p>你好，<?= auth()->user()->first_name ?></p>
    <a href="<?= url_to("logout") ?>" >登出</a>
<?php else: ?>
    <a href="<?= url_to("login") ?>" >點擊登入</a>
<?php endif; ?>
<!--List out all data-->
<?php foreach ($data as $d) : ?>
    <h1> 
        <!--點擊該Title進入編輯頁面-->
        <a href = "/article/Update/<?=$d->id?>"><?= "編號".$d->id."_".esc($d->Title)?></a>
    </h1> 
    <p> <?= esc($d->Content) ?></p>
<?Php endforeach; ?>
<!--------------------------------------------------->
<a href="<?= url_to("Article::create") ?>">新增一篇新文章</a>

<?= $this -> endsection() ?> 

