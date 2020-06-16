<?php

/**
 * Template Name: Encontro
 */

hm_get_template_part('templates/components/header', [
    'css' => 'template-encontro.css',
]); ?>

<div class="encontro-main-content">
	<div class="container">
		<!-- TITLE -->
		<div class="row row-title">
			<div class="col-12 col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row row-content">
			<div class="col-12 col-md-8 offset-md-2">
				<div class="row">
					<div class="col-md-12" style="text-align: center; margin-bottom: 4rem;">
						<p>Após mais um ano repleto de desafios e muito trabalho, chegou o momento de celebrar. E nada melhor do que comemorar nossas conquistas e vitórias junto de quem está sempre ao nosso lado. Vem aí o Encontro Ternium 2019 para você festejar com a sua família o orgulho de ser Ternium!</p>

						<p>E para ningém ficar de fora, vamos fazer a festa em dois dias, com as mesmas atrações e atividades. Dividimos as áreas por escalas, mantendo a integração entre funcionários das áreas administrativas e operacionais.</p>

						<p>Esperamos todos lá!</p>
					</div>
				</div>

				<h4 style="font-weight: 200;">Veja abaixo mais detalhes<br />sobre a festa:</h4>
				<hr />

				<div class="row row-details">
					<!-- COL ESQUERDA -->
					<div class="col-12 col-md-6">
						<div class="row">
							<div class="col-12 col-md-2">
								<img class="icon-enc" src="<?php echo get_template_directory_uri() .'/assets/img/enc_icon_01.png'; ?>">
							</div>
							<div class="col-12 col-md-10">
								<h5>Data:</h5>
								<p><strong>07 e 08 de dezembro de 2019</strong><br />(sábado e domingo)</p>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-2">
								<img class="icon-enc" src="<?php echo get_template_directory_uri() .'/assets/img/enc_icon_02.png'; ?>">
							</div>
							<div class="col-12 col-md-10">
								<h5>Horário:</h5>
								<p>11h às 16h</p>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-2">
								<img class="icon-enc" src="<?php echo get_template_directory_uri() .'/assets/img/enc_icon_03.png'; ?>">
							</div>
							<div class="col-12 col-md-10">
								<h5>Local:</h5>
								<p>Riocentro - Pavilhão 2 - Av. Salvador Allende, 6555 - Barra da Tijuca, Rio de Janeiro - RJ</p>
							</div>
						</div>

						<div class="row">
							<div class="col-12 col-md-2">
								<img class="icon-enc" src="<?php echo get_template_directory_uri() .'/assets/img/enc_icon_04.png'; ?>">
							</div>
							<div class="col-12 col-md-10">
								<h5>Quem eu posso levar:</h5>
								<p>Funcionário pode levar cônjuge e dependentes até 21 anos cadastrados no Plano de Saúde. Os que não possuem dependentes cadastrados ou solteiros, poderão levar 01 convidado.</p>
							</div>
						</div>
					</div>

					<!-- COL DIREITA -->
					<div class="col-12 col-md-6">
						<div class="row">
							<div class="col-12 col-md-2">
								<img class="icon-enc" src="<?php echo get_template_directory_uri() .'/assets/img/enc_icon_05.png'; ?>">
							</div>
							<div class="col-12 col-md-10">
								<h5>Terá transporte no dia?</h5>
								<p>Sim. As linhas e pontos de embarque serão os mesmos utilizados diariamente, mas os horários serão ajustados para atender a festa.</p>
								<p>Em sua inscrição você informou sua opção de transporte e caso tenha optado por usar o transporte coletivo da empresa, <strong>em breve divulgaremos os horários que serão adotados nas datas da festa. As informações serão enviadas por e-mail pela Ternium.</strong></p>
							</div>
						</div>
					</div>
				</div>


				<div class="row row-cronograma">
					<div class="col-12 col-md-12">
						<h4 style="font-weight: 200; margin-top: 3rem;">Cronograma<br />de Participação</h4>
						<hr />

						<div class="row">
							<div class="col-12 col-md-12">
								<p style="text-align: center;">A festa é para todos e para garantir que todos participem estabeleceremos a seguinte tabela de trocas: O turno branco trabalhará dia 04/12 no lugar do turno azul e vai na festa dia 08/12 (domingo). Já o turno Azul, trabalhará no dia 08/12 no lugar do turno branco e vai na festa 07/12 (sábado).</p>
							</div>
						</div>

						<div class="row" style="margin-bottom: 3rem;">
							<div class="col-12 col-md-12">
								<img src="<?php echo get_template_directory_uri() .'/assets/img/enc_table.png'; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php hm_get_template_part('templates/components/participe--confirm-form'); ?>
<?php hm_get_template_part('templates/components/footer'); ?>