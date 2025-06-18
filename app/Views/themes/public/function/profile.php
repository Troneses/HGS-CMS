<?php $this->extend('themes/public/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Профиль пользователя</h2>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Информация</h5>
            <p><strong>Имя:</strong> <?= esc($user['username']); ?></p>
            <p><strong>Email:</strong> <?= esc($user['email']); ?></p>
            <p><strong>Роль:</strong> <?= esc($user['role']); ?></p>
            <a href="/profile/edit" class="btn btn-primary">Редактировать</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Мои посты</h5>
            <?php if (!empty($posts)): ?>
                <ul class="list-group">
                    <?php foreach ($posts as $post): ?>
                        <li class="list-group-item">
                            <?= esc($post['title']); ?>
                            <a href="/posts/<?= esc($post['slug']); ?>" class="btn btn-sm btn-info float-end">Просмотр</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>У вас пока нет постов.</p>
            <?php endif; ?>
        </div>
    </div>
<?php $this->endSection(); ?>