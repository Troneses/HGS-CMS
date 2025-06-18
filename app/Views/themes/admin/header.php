<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'Админ-панель | HGS CMS' ?></title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin">Админ-панель</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Переключить навигацию">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/admin">Дашборд</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/users">Пользователи</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/posts">Посты</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/categories">Категории</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/profile">Профиль</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Выход</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-4">