<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>文章修改系統</title>
<?php if($data->image) : ?>
        <img src="<?= url_to("article/Image/show") ?>">
        <a href="<?= url_to("article/Image/delete") ?>"> <button name="But_DelImage">刪除圖片</button> </a>
<?php else: ?>
        <a href="<?= url_to("Article::ImageCreate") ?>"> <button name="But_Image">上傳圖片</button> </a>
<?php endif ?>
<!--------------------------------------------------->
<!--errors Section-->
<?php 
        if (session() -> get("UpdateErrors")!=null) : 
                echo "修改失敗，","<br>" ;
                foreach (session()->get("UpdateErrors") as $error) :
                        echo $error,"<br>" ;
                endforeach; 
        session() ->set("UpdateErrors",null);
        echo "<br>";
        endif; 
?>
<!--ImageDeletesuccess -->
<?php 
    if (session() -> get("ImageDeletesuccess")!=null) 
    {
        $id = session()->get("ImageDeletesuccess"); 
        echo $id ;
        session() ->set("ImageDeletesuccess",null);
    }  
?>

<?= form_open("Article/Update") ?>
<label for="title">文章標題</label>
        <input type="text" id="Title" name="Title" value="<?= $data->Title?>" ><!--value= old() -->

        <label for="content">內容</label>
        <textarea id="content" name="Content" ><?= $data->Content?></textarea> <!--TextArea沒有Value old()用法有差 -->

        <button >修改文章</button>
        
        <a href="<?= url_to("Article::Delete") ?>"> <button name="But_Delete">刪除文章</button> </a>
        
<?= $this -> endsection() ?> 


