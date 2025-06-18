<?php $this->extend('themes/admin/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Управление пользователями</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя пользователя</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['id']); ?></td>
                    <td><?= esc($user['username']); ?></td>
                    <td><?= esc($user['email']); ?></td>
                    <td><?= esc($user['role']); ?></td>
                    <td>
                        <a href="/admin/users/edit/<?= $user['id']; ?>" class="btn btn-sm btn-warning">Редактировать</a>
                        <a href="/admin/users/delete/<?= $user['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить пользователя?');">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php $this->endSection(); ?>