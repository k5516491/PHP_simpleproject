<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>信箱驗證 <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5">信箱驗證</h5>

            <?php if (session('error')) : ?>
                <div class="alert alert-danger"><?= esc(session('error')) ?></div>
            <?php endif ?>
            <p>請到信箱收信並將驗證碼複製輸入</p>
            <!-- <p> //lang('Auth.emailActivateBody') </p> -->

            <form action="<?= url_to('auth-action-verify') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Code -->
                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="floatingTokenInput" name="token" placeholder="000000" inputmode="numeric"
                        pattern="[0-9]*" autocomplete="one-time-code" value="<?= old('token') ?>" required>
                    <label for="floatingTokenInput">驗證碼</label>
                </div>

                <div class="d-grid col-8 mx-auto m-3">
                    <button type="submit" class="btn btn-primary btn-block">確認</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
