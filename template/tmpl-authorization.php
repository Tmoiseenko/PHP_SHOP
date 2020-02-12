<main class="page-authorization">
    <h1 class="h h--1">Авторизация</h1>
    <?php if ( $error_login ): ?>
        <span class="error-login">Не верно введен логин или пароль</span>
    <?php endif; ?>
    <form class="custom-form" action="#" method="post">
        <input type="email" class="custom-form__input" name="login" required="" value="<?= $_COOKIE['user_login'] ?? $_POST['login'] ?? ""?>">
        <input type="password" class="custom-form__input" name="password" required="">
        <button class="button" type="submit" name="auth">Войти в личный кабинет</button>
    </form>
</main>