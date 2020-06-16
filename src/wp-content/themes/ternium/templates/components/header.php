<?php
	session_start();

	## FAKE LOGIN SESSION
	/*
	$_SESSION['login'] = [
	 	'employee' => (object) [
	 		'info' => (object) [
	 			'id' => '1',
	 			'matricula' => '921501',
	 			'id_8' => '10266607',
	 			'nome' => 'celio adriano mendes vasconcelos',
	 			'escala' => 'amarela',
	 			'data_festa' => '43806',
	 			'cpf' => '7193240765',
	 			'cargo_nome' => 'assist seguranÇa empresarial ii',
	 			'estado_civil' => 'casado',
	 			'endereco' => 'jarbas de carvalho, 1532, ap30, recreio dos bandeira, rio de janeiro',
	 			'confirmado' => true,
				 'onibus' => true,
	 			'senha' => 1,
				 'obs' => 'asdasdasdas',
				 'email' => 'asdasd@asdasd.com',
				 'telefone' => '3216546',
	 		],
	 		'dependents' => [
	 		 (object) [
	 			 	'id' => 1,
	 				'nome' => 'andreia goncalves queiroz vasconcelos',
	 				'parentesco' => 'cônjuge',
	 				'data_nascimento' => '19/07/1974',
	 				'confirmado' => true
	 			],

	 		(object) [
	 				'id' => 2,
	 				'nome' => 'Valdeirciane',
	 				'parentesco' => 'cônjuge',
	 				'data_nascimento' => '19/07/1984',
	 				'confirmado' => false,
	 			],
	 		],
	 	],
	 ];
	*/

	if (!isset($_SESSION['login']))  header('Location: login');
	// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
	// 	session_unset();
	// 	session_destroy();
	// 	if (!isset($_SESSION['login']))  header('Location: login');
	// }
	// $_SESSION['LAST_ACTIVITY'] = time();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ternium</title>
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/vendor/fancybox/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/css/app-main.css">

	<?php $css = $template_args['css'] ?? null;?>
	<?php if ($css): ?>
		<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/assets/css/<?php echo $css; ?>">
	<?php endif; ?>

</head>
<body>
	<!-- top menu -->
	<?php hm_get_template_part('templates/components/menu'); ?>