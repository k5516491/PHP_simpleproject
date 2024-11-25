<?= $this -> extend("layouts/base") ?>
<?= $this -> section("content") ?> 
<title>使用者清單</title>
<div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover table-variants-striped-dark  align-middle mb-0">
                                <thead>
                                <tr class="bg-light-info">
                                    <th scope="col">編號</th>
                                    <th scope="col">姓名</th>
                                    <th scope="col">電子信箱</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach($User as $u) : ?> <!-- 每個tr代表一列 -->
                                <tr>

                                    <td><a href= "/admin/user/<?=$u->id?>"> <?= $u->id ?></a></td> 
                                    <td><?= $u->first_name ?></td>
                                    <td><?= $u->email?></td>
                                    <?= "<br>" ?>
                                    
                                </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
<?= $this->endsection() ?>