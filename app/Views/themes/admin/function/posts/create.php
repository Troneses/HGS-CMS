<?php $this->extend('themes/admin/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Создать пост</h2>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <form method="post" action="/admin/posts/create">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= old('title'); ?>" required>
            <?php if (isset($validation) && $validation->hasError('title')): ?>
                <div class="text-danger"><?= $validation->getError('title'); ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Слаг</label>
            <input type="text" class="form-control" id="slug" name="slug" value="<?= old('slug'); ?>" required>
            <?php if (isset($validation) && $validation->hasError('slug')): ?>
                <div class="text-danger"><?= $validation->getError('slug'); ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">Без категории</option>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= esc($category['id']); ?>" <?= old('category_id') == $category['id'] ? 'selected' : ''; ?>>
                            <?= esc($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled>Нет категорий</option>
                <?php endif; ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('category_id')): ?>
                <div class="text-danger"><?= $validation->getError('category_id'); ?></div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Содержание</label>
            <textarea class="form-control" id="content" name="content" rows="10" required><?= old('content'); ?></textarea>
            <?php if (isset($validation) && $validation->hasError('content')): ?>
                <div class="text-danger"><?= $validation->getError('content'); ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
        <a href="/admin/posts" class="btn btn-secondary">Отмена</a>
    </form>
<?php $this->endSection(); ?>