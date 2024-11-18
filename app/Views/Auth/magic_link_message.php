<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>使用信箱登入 <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5">使用信箱登入</h5>

            <p><b>確認您的信箱</b></p>

            <p><?= lang("已經發送登入驗證信到您的信箱了，信件有效時間為一小時", [setting('Auth.magicLinkLifetime') / 60]) ?></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
