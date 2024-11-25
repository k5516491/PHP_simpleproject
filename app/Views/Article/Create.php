<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>文章上傳系統</title>
<!--------------------------------------------------->
<!--CreatErrors Section-->
<?php 
        if (session() -> get("errors")!=null) : 
                echo "上傳失敗，","<br>" ;
                foreach (session()->get("errors") as $error) :
                        echo $error,"<br>" ;
                endforeach; 
        session() ->set("errors",null);
        echo "<br>";
        endif; ?>
<!--------------------------------------------------->
<?= form_open("Article/create") ?>
        <label for="title">文章標題</label>
        <input type="text" id="Title" name="Title" value="<?= old("Title") ?>" ><!--value= old() -->

        <label for="content">內容</label>
        <textarea id="content" name="Content" ><?= old("Content") ?></textarea> <!--TextArea沒有Value old()用法有差 -->
        <button>上傳</button>
<?= $this -> endsection() ?> 

