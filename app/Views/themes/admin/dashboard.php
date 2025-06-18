<?php $this->extend('themes/admin/layout'); ?>
<?php $this->section('content'); ?>
    <h2>Дашборд</h2>
    <p>Добро пожаловать в админ-панель HGS CMS!</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Пользователи</h5>
                    <p class="card-text">Управление зарегистрированными пользователями.</p>
                    <a href="/admin/users" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Посты</h5>
                    <p class="card-text">Создание и редактирование постов.</p>
                    <a href="/admin/posts" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Категории</h5>
                    <p class="card-text">Управление категориями контента.</p>
                    <a href="/admin/categories" class="btn btn-primary">Перейти</a>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection(); ?>