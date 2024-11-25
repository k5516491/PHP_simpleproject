<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>使用者</title>
<?php
    if (session()->has("message")) //暫時關閉，因為都英文
    {
        echo session("message");
    }  
?>
<dl>
    <dt>使用者姓名:</dt>
    <dd><?= $User->first_name ?></dd>

    <dt>電子信箱:</dt>
    <dd><?= $User->email ?></dd>

    <dt>帳號創立於:</dt>
    <dd><?= $User->created_at->humanize() ?></dd>

    <dt> <a href= "/admin/user/<?=$User->id?>/group"> 身分:(點選修改) </a></dt>
    <dd><?= implode(", ", $User->getGroups()) ?></dd>

</dl>

<?= $this->endsection() ?>