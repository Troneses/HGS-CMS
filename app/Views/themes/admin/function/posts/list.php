<?php $this->extend('themes/admin/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Посты</h2>
    <a href="/admin/posts/create" class="btn btn-primary mb-3">Создать пост</a>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (empty($posts)): ?>
        <p>Постов пока нет.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Автор</th>
                    <th>Категория</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= esc($post['id']); ?></td>
                        <td><?= esc($post['title']); ?></td>
                        <td><?= esc($post['username']); ?></td>
                        <td><?= esc($post['category_name'] ?? 'Без категории'); ?></td>
                        <td><?= esc($post['created_at']); ?></td>
                        <td>
                            <a href="/admin/posts/edit/<?= $post['id']; ?>" class="btn btn-sm btn-warning">Редактировать</a>
                            <a href="/admin/posts/delete/<?= $post['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить пост?');">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $this->endSection(); ?>