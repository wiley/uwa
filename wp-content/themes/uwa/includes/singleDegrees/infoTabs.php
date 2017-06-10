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
      <?php include ('infoTabs/courseDetails.php'); ?>
      <?php include ('infoTabs/concentrations.php'); ?>
      <?php include ('admission.php'); ?>
      <?php include ('infoTabs/tuition.php'); ?>
      <?php include ('infoTabs/transfer.php'); ?>
    </div>
  </div>
</div>
