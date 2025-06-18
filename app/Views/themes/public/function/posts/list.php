<?php $this->extend('themes/public/layout'); ?>
<?php $this->section('content'); ?>
    <h1>Посты</h1>
    <?php if (empty($posts)): ?>
        <p>Пока нет постов.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/posts/<?= esc($post['slug']); ?>"><?= esc($post['title']); ?></a></h5>
                            <p class="card-text"><?= substr(esc($post['content']), 0, 150); ?>...</p>
                            <p class="card-text"><small class="text-muted">Автор: <?= esc($post['username']); ?> | Опубликовано: <?= esc($post['created_at']); ?></small></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php $this->endSection(); ?>