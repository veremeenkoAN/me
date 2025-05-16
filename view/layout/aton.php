<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aton</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header__inner">
            <a href="/"><img class="header__logo" width="200" class="header__logo" src="/images/aton1.png" alt=""></a>
            <nav class="nav">
                <ul class="header__menu-list">
                    <li class="header__item"><a class="header__item-link" href="/country">Страны</a></li>
                    <li class="header__item"><a class="header__item-link" href="/city">Города</a></li>
                    <li class="header__item"><a class="header__item-link" href="/user">Пользователи</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<main>
    <?= $this->innerHtml ?>
</main>
