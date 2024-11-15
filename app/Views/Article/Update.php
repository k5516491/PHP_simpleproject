<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>文章修改系統</title>
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
<?= form_open("Article/Update") ?>
<label for="title">文章標題</label>
        <input type="text" id="Title" name="Title" value="<?= $data->Title?>" ><!--value= old() -->

        <label for="content">內容</label>
        <textarea id="content" name="Content" ><?= $data->Content?></textarea> <!--TextArea沒有Value old()用法有差 -->
        <button>修改</button>
<?= $this -> endsection() ?> 


