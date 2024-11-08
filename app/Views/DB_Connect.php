<?= $this->extend("Layouts/base"); ?> <!--這裡先到base.php抓template -->
<?= $this->section("content"); ?>
<form method="post">
    <h2>在學生資料表新增一名學生</h2>

    <input type="text" name="studentname" value="<?= set_value('studentname');?>">
    </input>
    <input type="submit" name="AddButton" value="新增" >
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
    </div>
</form>

<?= $this->endsection(); ?>