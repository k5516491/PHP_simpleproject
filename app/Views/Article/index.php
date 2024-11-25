<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>所有文章</title>

<!--------------------------------------------------->
<!--CreateSuccess Section-->
<?php 
    if (session()->has("CreateSuccess")) //暫時關閉，因為都英文
    {
        echo session("CreateSuccess");
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
<!--ImageUploadsuccess Section-->
<?php 
    if (session() -> get("ImageUploadsuccess")!=null) 
    {
        $id = session()->get("ImageUploadsuccess"); 
        echo $id ;
        session() ->set("ImageUploadsuccess",null);
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

<!--------------------------------------------------->

<!--List out all data-->
<?php foreach ($data as $d) : ?>
    <h1> 
        <!--點擊該Title進入編輯頁面-->
        <a href = "/article/Update/<?=$d->id?>"><button>
            <?= $d->id."號文章: ".esc($d->Title)?></button>
            
        </a>
    </h1>
    <p>內文: <?= esc($d->Content) ?></p>
    <p>作者_<?= esc($d->first_name) ?></p>
<?Php endforeach; ?>
<!--------------------------------------------------->
<?= $pager -> simpleLinks() ?>
<a href="<?= url_to("Article::create") ?>">新增一篇新文章</a>

<?= $this -> endsection() ?> 

