<?php 
	require_once 'includes/db.php';
	include 'header.php';
?>
<?php if (isset($_SESSION['logged_user'])) : ?>

	Авторизован!<br>
	Привет, <?php echo ($_SESSION['logged_user']->login) ?>
	<hr>
	<a href="/logout.php">Выйти</a>

<?php else : ?>
	Вы не авторизованы! <br>
	<a href="/login.php">Войти</a>
	<a href="/signup.php">Зарегистрироваться</a>

<?php endif; ?>

<?php include 'footer.php'; ?>
