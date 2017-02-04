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

					<div id="js-modal-<?php echo $modalId; ?>" class="modal" aria-hidden="true" role="dialog" aria-labbeledby="js-modal-<?php echo $modalId; ?>__header">
						<a href="#" class="js-modal__close js-modal__close_overlay"></a>
						<div class="modal__content" role="document" tabindex="0">
							<a role="button" aria-label="Close Modal Window" href="#" class="js-modal__close">&times; Close</a>
							<?php echo $modalContent; ?>
						</div>
					</div>
				<?php endwhile; ?>
		<?php endif; ?>




		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

        <!-- <script type='text/javascript' id="__bs_script__">
            //<![CDATA[
            document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.10.1.js'><\/script>".replace("HOST", location.hostname));
            //]]>
        </script> -->

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


<script type="text/javascript">
jQuery(document).ready(function($) {

	(function () {
		var modalToggle = $('.js-modal');
		var closeButton = $('.js-modal__close');

		var modalWindowID = '';
		var modalWindow  = '';

		// var closeButton = '';


		function openModal (e) {
			e.preventDefault();
			modalWindowID = '#' + $(this).data( "modal" ); // get target modal
			modalWindow = $(modalWindowID);
			var modalContent = $(modalWindowID).find('.modal__content');

			modalWindow.addClass('open').attr("aria-hidden","false");
				console.log(modalContent);
			modalContent.focus();
			closeButton.click(closeModal);
		}

		function closeModal () {
			modalWindow.removeClass('open');
			modalFirstFocus = '';
			modalLastItem = '';
			modalClose = '';
			modalWindow = '';
			modalContent = '';
			modalWindowID = '';
		}

		modalToggle.click(openModal);





	})();

}); /* end of as page load scripts */

</script>



	</body>

</html> <!-- end of site. what a ride! -->
