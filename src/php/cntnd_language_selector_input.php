?><?php
// cntnd_language_selector_input

// includes
cInclude('module', 'includes/style.cntnd_language_selector_output-or-input.php');
cInclude('module', 'includes/class.cntnd_language_selector.php');
cInclude('module', 'includes/class.cntnd_util.php');

// input/vars
$activate = (bool) "CMS_VALUE[1]";
$showDisabled = "CMS_VALUE[2]";
if (empty($showDisabled) || !is_bool($showDisabled)){
    $showDisabled=true;
}
$template = "CMS_VALUE[3]";
if (!CntndUtil::isTemplate('cntnd_language_selector', $client, $template)){
    $template="default.html";
}

// other vars
$uuid = rand();
$templates = CntndUtil::templates('cntnd_language_selector', $client);


?>
<div class="form-vertical">
  <p><strong><?= mi18n("ACTIVATE_LABEL") ?></strong></p>
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

    <div class="form-group">
        <label for="template_<?= $uuid ?>"><?= mi18n("TEMPLATE") ?></label>
        <select name="CMS_VAR[3]" id="template_<?= $uuid ?>" size="1">
            <option value="false"><?= mi18n("SELECT_CHOOSE") ?></option>
            <?php
            foreach ($templates as $template_file) {
                $selected="";
                if ($template==$template_file){
                    $selected = 'selected="selected"';
                }
                echo '<option value="'.$template_file.'" '.$selected.'>'.$template_file.'</option>';
            }
            ?>
        </select>
    </div>
</div>
<?php
