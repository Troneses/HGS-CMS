<?php $this->extend('themes/admin/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Создать категорию</h2>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <form method="post" action="/admin/categories/create">
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name'); ?>" required>
            <?php if (isset($validation) && $validation->hasError('name')): ?>
                <div class="text-danger"><?= $validation->getError('name'); ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Слаг</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?= old('slug'); ?>" required>
            <?php if (isset($validation) && $validation->hasError('slug')): ?>
                <div class="text-danger"><?= $validation->getError('slug'); ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="/admin/categories" class="btn btn-secondary">Отмена</a>
    </form>
<?php $this->endSection(); ?>