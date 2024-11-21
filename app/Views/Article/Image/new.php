<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>圖片上傳</title>
<!--------------------------------------------------->
<?= form_open_multipart("Article/ImageCreate") ?>
        
        <input type="file" id="image" name="image">
        <button name="But_Upload">上傳</button>
</form>
<?= $this -> endsection() ?> 


