<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>二階段認證 <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5">二階段認證</h5>

            <p>確認您的電子信箱</p>

            <?php if (session('error')) : ?>
                <div class="alert alert-danger"><?= "確認失敗，輸入的email與紀錄不符" ?></div>
            <?php endif ?>

            <form action="<?= url_to('auth-action-handle') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="mb-2">
                    <input type="email" class="form-control" name="email"
                        inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>"
                        <?php /** @var CodeIgniter\Shield\Entities\User $user */ ?>
                        value="<?= old('email', $user->email) ?>" required>
                </div>

                <div class="d-grid col-8 mx-auto m-3">
                    <button type="submit" class="btn btn-primary btn-block">發送認證信</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
