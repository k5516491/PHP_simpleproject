<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<?= form_open("Article/create") ?>
        <label for="title">文章標題</label>
        <input type="text" id="Title" name="Title">

        <label for="content">內容</label>
        <textarea id="content" name="Content"></textarea>
        <button>上傳</button>
<?= $this -> endsection() ?> 

