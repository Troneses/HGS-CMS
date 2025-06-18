<?php $this->extend('themes/admin/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Редактировать пользователя</h2>
    <form method="post" action="/admin/users/edit/<?= $user['id']; ?>">
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
            <label for="role" class="form-label">Роль</label>
            <select class="form-control" id="role" name="role" required>
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>Пользователь</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Администратор</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="/admin/users" class="btn btn-secondary">Отмена</a>
    </form>
<?php $this->endSection(); ?>