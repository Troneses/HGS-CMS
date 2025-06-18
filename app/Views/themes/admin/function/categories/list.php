<?php $this->extend('themes/admin/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Категории</h2>
    <a href="/admin/categories/create" class="btn btn-primary mb-3">Создать категорию</a>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (empty($categories)): ?>
        <p>Категорий пока нет.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Слаг</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= esc($category['id']); ?></td>
                        <td><?= esc($category['name']); ?></td>
                        <td><?= esc($category['slug']); ?></td>
                        <td>
                            <a href="/admin/categories/edit/<?= $category['id']; ?>" class="btn btn-sm btn-warning">Редактировать</a>
                            <a href="/admin/categories/delete/<?= $category['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Удалить категорию?');">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $this->endSection(); ?>