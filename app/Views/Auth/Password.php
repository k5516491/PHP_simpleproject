<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>重設密碼<?= $this->endSection() ?>

<?= $this->section('main') ?>
<h5 class="card-title mb-5">重設密碼</h5>
<!--------------------------------------------------->
<!--errors Section-->
<?php 
        if (session() -> get("SetPasswordErrors")!=null) : 
                echo "變更失敗，","<br>" ;
                foreach (session()->get("SetPasswordErrors") as $error) :
                        echo $error,"<br>" ;
                endforeach; 
        session() ->set("SetPasswordErrors",null);
        echo "<br>";
        endif; 
?>
<!--------------------------------------------------->
<!--Body-->
<?= form_open("set-password") ?>
    <!-- Password -->
    <label for>新密碼</label>
    <input type="password" id="password" name="password" >
    <!-- RePassword -->
    <label>再次輸入新密碼</label>
    <input type="password" id="password_again" name="password_again" >
    <button name="But_ChangePW">變更密碼</button>
</form>

<?= $this->endSection() ?>
