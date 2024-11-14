<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>文章上傳系統</title>
<!--------------------------------------------------->
<!--errors Section-->
<?php 
    if (session() -> has("errors")) : 
    echo "上傳失敗，","<br>" ;
        foreach (session()->get("errors") as $error) :
            echo $error,"<br>" ;
        endforeach; 
    endif; 
?>
<!--------------------------------------------------->
<!--success Section-->
<?php 
    if (session() -> get("success")!=null) 
    {
        $title = session()->get("success"); 
        echo "新的文章-" .$title. " 上傳成功!!"."<br>" ;
        session() ->set("success",null);
    }   
 ?>
<!--------------------------------------------------->
<!--List out all data-->
<?php foreach ($data as $d) : ?>
    <h1> <?= $d['Title'] ?> </h1>
    <p> <?= $d['Content'] ?></p>
<?Php endforeach; ?>
<!--------------------------------------------------->
<a href="<?= url_to("Article::create") ?>">新增一篇新文章</a>

<?= $this -> endsection() ?> 

