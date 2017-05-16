<?php
	require_once 'includes/db.php';
	include 'header.php';

	$data = $_POST;
	if(isset($data['do_signup'])){
		//регистрация

		$errors = array();
		if(trim($data['login']) == ''){
			$errors[] = 'Введите логин!';
		}
		if(trim($data['email']) == ''){
			$errors[] = 'Введите email!';
		}
		if($data['password'] == ''){
			$errors[] = 'Введите пароль!';
		}
		if($data['password_2'] != $data['password']){
			$errors[] = 'Повторный пароль введен неверно';
		}
		/* Для одновременной проверки на логин и емейл запись будет такая 
			if(R::count('users', 'login = ? OR email = ?', array($data['login'], $data['email'])) > 0){
				$errors[] = 'Пользователь с таким логином или email уже существует';
			}
		*/
		if(R::count('users', 'login = ?', array($data['login'])) > 0){
			$errors[] = 'Пользователь с таким логином уже существует';
		}
		if(R::count('users', 'email = ?', array($data['email'])) > 0){
			$errors[] = 'Пользователь с таким email уже существует';
		}

		if(empty($errors)){
			//Ошибок нет, регистрируем
			$user = R::dispense('users');
			$user->login = trim($data['login']);
			$user->email = trim($data['email']);
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			R::store($user);
			echo '<div style="color: green;">Регистрация прошла успешно, можете перейти на <a href="/login.php">страницу авторизации</a> </div>';
		}else{
			echo '<div style="color: red;">'.$errors[0].'</div>';
		}

	}
?>



<form action="signup.php" method="POST">
	<p>
		<p><strong>Ваш логин</strong>:</p>
		<input type="text" name="login" value="<?php echo @$data[login]; ?>">

		<p><strong>Ваш email</strong>:</p>
		<input type="email" name="email" value="<?php echo @$data[email]; ?>">

		<p><strong>Ваш пароль</strong>:</p>
		<input type="password" name="password">

		<p><strong>Повторите пароль</strong>:</p>
		<input type="password" name="password_2">

		<p>
			<button type="submin" name="do_signup">Зарегистрироваться</button>
		</p>
	</p>
</form>

<?php include 'footer.php'; ?>