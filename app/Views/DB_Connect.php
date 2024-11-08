<?= $this->extend("Layouts/base"); ?> <!--這裡先到base.php抓template -->
<?= $this->section("content"); ?>
<form method="post">
    <h2>在學生資料表新增一名學生</h2>

    <input type="text" name="studentname" value="<?= set_value('studentname');?>">
    </input>
    <input type="submit" name="AddButton" value="新增" >
    <p>目前的所有學生: 
        <?php $count = 0; 
        foreach($studenttttt as $studen){ 
            $count+=1 ;} 
        foreach($studenttttt as $studen){ 
            if($count>1)
                {
                    echo $studen->student_name ."、";
                }
            else
                {
                    echo $studen->student_name ;
                } 
            $count-=1 ;
            }
        ?>
    </p>
    </div>
</form>

<?= $this->endsection(); ?>