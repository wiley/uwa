		<footer class="footer cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div class="wrap cf">

					<img src="/wp-content/uploads/2017/01/footer__uwa-logo.svg" alt="UWA Online Logo">
					<p class="footer__copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <a href="/privacy-policy/" target="_blank">Privacy Policy</a></p>

				</div>

			</footer>

		</div>

		<?php
		if( have_rows('modal') ):

				while ( have_rows('modal') ) : the_row();

				$modalId = get_sub_field('modal_id');
				$modalContent = get_sub_field('modal_content'); ?>

					<div id="<?php echo $modalId; ?>" class="modal" aria-hidden="true" role="dialog" aria-labbeledby="modal__header">
						<a href="#" class="js-modal__close js-modal__close_overlay"></a>
						<div class="modal__content">
							<a href="#" class="js-modal__close">&times; Close</a>
							<?php echo $modalContent; ?>
						</div>
					</div>
				<?php endwhile; ?>
		<?php endif; ?>




		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

				<script type="text/javascript">
					WebFontConfig = {
						google: { families: [ 'Open+Sans:400,400i,700,700i' ] }
					};
					(function() {
						var wf = document.createElement('script');
						wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
						wf.type = 'text/javascript';
						wf.async = 'true';
						var s = document.getElementsByTagName('script')[0];
						s.parentNode.insertBefore(wf, s);
					})();
				</script>

	</body>

</html> <!-- end of site. what a ride! -->
