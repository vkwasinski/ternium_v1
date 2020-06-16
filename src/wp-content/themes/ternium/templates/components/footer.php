	
	<div class="container">
		<div class="row row-footer">
			
		</div>
	</div>

	<input type="hidden" id="nonce" value="<?php echo wp_create_nonce( 'wp_rest' ); ?>">
	<input type="hidden" id="wpurl" value="<?php echo site_url('/wp-json/api/v1/'); ?>">

	<!-- scripts -->
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/vendor/fancybox/jquery.fancybox.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/sweetalert2.all.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/vendor/jquery.mask.min.js"></script>
	<script src="<?php echo bloginfo('template_url'); ?>/assets/js/global.js"></script>

	<?php $js = $template_args['js'] ?? null;?>
	<?php if ($js): ?>
		<script src="<?php echo bloginfo('template_url'); ?>/assets/js/<?php echo $js; ?>"></script>
	<?php endif; ?>
</body>
</html>