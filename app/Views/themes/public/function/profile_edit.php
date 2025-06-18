<?php $this->extend('themes/public/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Редактировать профиль</h2>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>
    <form method="post" action="/profile/edit">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="username" class="form-label">Имя пользователя</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']); ?>" required>
            <?php if (isset($validation) && $validation->hasError('username')): ?>
                <div class="text-danger"><?= $validation->getError('username'); ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']); ?>" required>
            <?php if (isset($validation) && $validation->hasError('email')): ?>
                <div class="text-danger"><?= $validation->getError('email'); ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Новый пароль (оставьте пустым, если не меняете)</label>
            <input type="password" class="form-control" id="password" name="password">
            <?php if (isset($validation) && $validation->hasError('password')): ?>
                <div class="text-danger"><?= $validation->getError('password'); ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/profile" class="btn btn-secondary">Отмена</a>
    </form>
<?php $this->endSection(); ?>