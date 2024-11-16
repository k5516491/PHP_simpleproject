<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>文章刪除</title>
<?php
        $id = session() -> get("DeletedID") ;
?>
<h1>是否確定刪除編號<?=$id?>的文章?</h1>
<?= form_open("Article/delete") ?>
        <button name="confirm">確認</button>
        <button name="cancel">取消</button>
</form>

<?= $this -> endsection() ?> 