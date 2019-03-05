<div class="wrap cf">
  <div class="infoTabs">
    <div class="infoTabs__buttons" role="tablist">
      <button id="details" class="active" role="tab" aria-selected="true" aria-controls="content-details">Course Information</button>

      <?php if (get_field('certificate_accordion')): ?>
        <button id="certificates" role="tab" aria-selected="false" aria-controls="content-certificates">Certificates</button>
      <?php endif; ?>

      <?php if (get_field('concentrations_intro') || get_field('concentration_accordion')): ?>
        <button id="concentrations" role="tab" aria-selected="false" aria-controls="content-conentrations">Concentrations</button>
      <?php endif; ?>

      <?php if (get_field('completion_info')): ?>
        <button id="completion" role="tab" aria-selected="false" aria-controls="content-completion">Program Completion Requirements</button>
      <?php endif; ?>

      <button id="admission" role="tab" aria-selected="false" aria-controls="content-admission">Admission Requirements</button>
      <button id="tuition" role="tab" aria-selected="false" aria-controls="content-tuition">Tuition & Financing</button>
      <button id="transfer" role="tab" aria-selected="false" aria-controls="content-transfer">Transfer Credit Policy</button>
      <div type="button" class="btn-info requestInfo" aria-label="Open Request Information Form Window" name="button">Get Started</div>
    </div>

    <div class="infoTabs__contentWrapper">

      <?php include ('infoTabs/courseDetails.php'); ?>
      <?php include ('infoTabs/certificates.php'); ?>

      <?php if (get_field('concentrations_intro') || get_field('concentration_accordion')): ?>
        <?php include ('infoTabs/concentrations.php'); ?>
      <?php endif; ?>


      <?php if (get_field('completion_info')): ?>
        <?php include ('infoTabs/completion.php'); ?>
      <?php endif; ?>
      <?php include ('infoTabs/admission.php'); ?>

      <?php include ('infoTabs/tuition.php'); ?>

      <?php include ('infoTabs/transfer.php'); ?>

    </div>
  </div>
</div>
