$(document).ready(function() {
    // Загрузка сохранённой темы из localStorage
    if (localStorage.getItem('theme') === 'dark') {
        $('body').addClass('dark-theme');
        $('#theme-toggle').text('Светлая тема');
    }

    // Переключение темы
    $('#theme-toggle').click(function() {
        $('body').toggleClass('dark-theme');
        if ($('body').hasClass('dark-theme')) {
            localStorage.setItem('theme', 'dark');
            $(this).text('Светлая тема');
        } else {
            localStorage.setItem('theme', 'light');
            $(this).text('Тёмная тема');
        }
    });
});