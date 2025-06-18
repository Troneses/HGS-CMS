<?php $this->extend('themes/public/layout'); ?>
<?php $this->section('content'); ?>
    <h1><?= esc($post['title']); ?></h1>
    <p class="text-muted">
        Автор: <?= esc($post['username']); ?> |
        Категория: <?= esc($post['category_name'] ?? 'Без категории'); ?> |
        Опубликовано: <?= esc($post['created_at']); ?>
    </p>
    <div class="content">
        <?= nl2br(esc($post['content'])); ?>
    </div>
    <a href="/posts" class="btn btn-secondary mt-3">Назад к постам</a>
<?php $this->endSection(); ?>