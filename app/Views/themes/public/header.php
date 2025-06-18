<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'HGS CMS' ?></title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/vendor/dropzone/dropzone.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">HGS CMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Переключить навигацию">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="/posts">Посты</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profile">Профиль</a></li>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item"><a class="nav-link" href="/logout">Выход</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/login">Вход</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register">Регистрация</a></li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <button id="theme-toggle" class="btn btn-outline-light btn-sm">Тёмная тема</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">