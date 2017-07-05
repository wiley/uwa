<div id="content-concentrations" class="concentrations infoTabs__content" aria-labelledby="concentrations" role="tabpanel">
  <?php if( have_rows('concentration_accordion') ): $i = 0;?>
    <h2 class="section-heading">Concentrations</h2>
    <?php include 'concentrationAccordion.php'; ?>
  <?php endif; ?>
</div>
