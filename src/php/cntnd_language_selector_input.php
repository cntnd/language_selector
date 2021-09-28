?><?php
// cntnd_language_selector_input

// input/vars
$uuid = rand();
$activate = (bool) "CMS_VALUE[1]";
$showDisabled = "CMS_VALUE[2]";
if (empty($showDisabled) || !is_bool($showDisabled)){
    $showDisabled=true;
}

// includes
cInclude('module', 'includes/style.cntnd_language_selector_output-or-input.php');

?>
<div class="form-vertical">
  <strong><?= mi18n("ACTIVATE_LABEL") ?></strong>
  <div class="form-check form-check-inline">
    <input id="activate_<?= $uuid ?>" class="form-check-input" type="radio" name="CMS_VAR[1]" value="true" <?php if($activate){ echo 'checked'; } ?> />
    <label for="activate_<?= $uuid ?>"><?= mi18n("ACTIVATE") ?></label>

      <input id="deactivate_<?= $uuid ?>" class="form-check-input" type="radio" name="CMS_VAR[1]" value="false" <?php if(!$activate){ echo 'checked'; } ?> />
      <label for="deactivate_<?= $uuid ?>"><?= mi18n("DEACTIVATE") ?></label>
  </div>

  <hr />

  <div class="form-check form-check-inline">
      <input id="show_lang_disabled_<?= $uuid ?>" class="form-check-input" type="checkbox" name="CMS_VAR[2]" value="true" <?php if($showDisabled){ echo 'checked'; } ?> />
      <label for=show_lang_disabled"_<?= $uuid ?>"><?= mi18n("SHOW_DISABLED") ?></label>
  </div>
</div>
<?php
