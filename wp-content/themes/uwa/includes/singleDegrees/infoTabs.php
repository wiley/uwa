<div class="wrap cf">
  <div class="infoTabs">
    <div class="infoTabs__buttons" role="tablist">
      <button id="details" class="active" role="tab" aria-selected="true" aria-controls="content-details">Course Information</button>
      <button id="concentrations" role="tab" aria-selected="false" aria-controls="content-conentrations">Concentrations</button>
      <button id="admission" role="tab" aria-selected="false" aria-controls="content-admission">Admission Requirements</button>
      <button id="tuition" role="tab" aria-selected="false" aria-controls="content-tuition">Tuition & Financing</button>
      <button id="transfer" role="tab" aria-selected="false" aria-controls="content-transfer">Transfer Credit Policy</button>
    </div>
    <div class="infoTabs__contentWrapper">
      <?php include ('courseDetails.php'); ?>
      <?php include ('concentrations.php'); ?>
      <?php include ('admission.php'); ?>
      <?php include ('tuition.php'); ?>
      <?php include ('transfer.php'); ?>
    </div>
  </div>
</div>
