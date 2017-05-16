<?php
	require_once 'includes/db.php';
	include 'header.php';

	$data = $_POST;
	
	if(isset($data['do_login'])){
		$errors = array();
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if($user){
			// Если такой пользователь существует
			if(password_verify($data['password'], $user->password)){
				// Eсли пароль верный
				$_SESSION['logged_user'] = $user;
				echo '<div style="color: green;">Вы авторизованы, можете перейти на <a href="/">главную страницу</a> </div>';
			}else{
				$errors[] = 'Неверно введен пароль';
			}
		}else{
			$errors[] = 'Пользователя с таким именем не существует';
		}
		if(!empty($errors)){
			echo '<div style="color: red;">'.$errors[0].'</div>';
		}
	}

?>



<form action="login.php" method="POST">
	<p>
		<p><strong>Логин</strong>:</p>
		<input type="text" name="login" value="<?php echo @$data[login]; ?>">

		<p><strong>Пароль</strong>:</p>
		<input type="password" name="password">

		<p>
			<button type="submin" name="do_login">Войти</button>
		</p>
	</p>
</form>

<?php include 'footer.php'; ?>