<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>使用者身分</title>
當前檢視使用者: <?= $User->first_name?>

<?= form_open("admin/user/".$User->id . "/group") ?>
    <?php if ($User->id === auth()->user()->id) :?>
        <label>
            <input type="checkbox" checked disabled> admin
            <input type="hidden" name="group[]" value="admin">
            
        </label>
    <?php else :?>
        <label>
            <input type="checkbox" name="group[]" value="admin"
            <?= $User->inGroup("admin") ? "checked" : "" ?>>管理員(admin)
        </label>
    <?php endif ; ?>
    <label>
            <input type="checkbox" name="group[]" value="leader"
            <?= $User->inGroup("leader") ? "checked" : "" ?>> 文章管理員(leader)
    </label>
    <label>
            <input type="checkbox" name="group[]" value="user"
            <?= $User->inGroup("user") ? "checked" : "" ?>> 學生(user)
    </label>
    <button>儲存</button>
</form>
<?= $this->endsection() ?>