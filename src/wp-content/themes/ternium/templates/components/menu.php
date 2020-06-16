<!-- TOP MENU -->
<section class="main-menu">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 logo-menu">
				<a href="<?php echo bloginfo('url'); ?>">
					<img src="<?php echo bloginfo('template_url'); ?>/assets/img/logo_ternium.png" >
				</a>
			</div>

			<div class="col-md-8  menu-list" style="margin-left: 40px;">
				<?php $nav_menu = wp_get_nav_menu_items('main-menu'); ?>
				<div class="menu">
					<ul>
						<?php foreach ($nav_menu as $item): ?>
							<li>
								<a href="<?php echo $item->url ; ?>">
									<?php echo $item->title; ?>
								</a>
							</li>
						<?php endforeach; ?>
						<li><a href="javascript:;" id="btn_menu_logout">Sair</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>