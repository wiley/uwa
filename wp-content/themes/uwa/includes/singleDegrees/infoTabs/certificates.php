<div id="content-certificates" class="certificates infoTabs__content" aria-labelledby="certificates" role="tabpanel">
  <?php if( have_rows('certificate_accordion') ): $i = 0;?>
    <h2 class="section-heading">Certificates</h2>
    <?php include 'certificateAccordion.php'; ?>
  <?php endif; ?>
</div>
