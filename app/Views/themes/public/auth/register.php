<?php $this->extend('themes/public/layout'); ?>
<?php $this->section('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Регистрация</h2>
            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>
            <form method="post" action="/register">
                <div class="mb-3">
                    <label for="username" class="form-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('username')): ?>
                        <div class="text-danger"><?= $validation->getError('username') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                        <div class="text-danger"><?= $validation->getError('email') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <?php if (isset($validation) && $validation->hasError('password')): ?>
                        <div class="text-danger"><?= $validation->getError('password') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Подтверждение пароля</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                    <?php if (isset($validation) && $validation->hasError('password_confirm')): ?>
                        <div class="text-danger"><?= $validation->getError('password_confirm') ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                <p class="text-center mt-3">Уже есть аккаунт? <a href="/login">Войдите</a></p>
            </form>
        </div>
    </div>
<?php $this->endSection(); ?>