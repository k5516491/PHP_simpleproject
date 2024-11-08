<?php $page_Session = \config\Services::session(); 
?> <!--使用session來跳出提示訊息 -->
<?= $this->extend("Layouts/base"); ?> <!--這裡先到base.php抓template -->


<?= $this->section("content"); ?>

<form method="post">
    <div class="container">

        <?php if(strlen($page_Session-> getTempdata('error'))>3): ?>
            <div class="alert" alert-error>
                <?=$page_Session->getTempdata('error')?>
                <script>
                alert("輸入不能為空白");
                </script>
            </div>
        <?php endif; ?>

        <?php if(strlen($page_Session-> getTempdata('errorD'))>3): ?>
            <div class="alert" alert-error>
                <?=$page_Session->getTempdata('errorD')?>
                <script>
                alert("此學生重複輸入");
                </script>
            </div>
        <?php endif; ?>

        <?php if(strlen($page_Session-> getTempdata('success'))>3): ?>
            <div class="alert" alert-success>
                <?=$page_Session->getTempdata('success')?>
            </div>
        <?php endif; ?>

    </div>
    <p>目前的所有學生: 
        <?php $count = 0; 
        //這裡是以string被傳入不知道怎麼拿count，所以土法煉鋼自己寫了counter
        foreach($studenttttt as $studen){  
            $count+=1 ;} 
        foreach($studenttttt as $studen){ 
            if($count>1)
                {
                    echo $studen->student_name ."、";
                }
            else
                {
                    echo $studen->student_name ; //輸出的最後一個學生後面不用加頓號
                } 
            $count-=1 ;
            }
        ?>
    </p>
    <div class = 'form-group'>
        <input type="text" name="studentname" value="<?= set_value('studentname');?>"> </input>
        
        <input type="submit" name="AddButton" value="新增" class='btn btn-primary'>
    </div>
    </div>
</form>

<?= $this->endsection(); ?>