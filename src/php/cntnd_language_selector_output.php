<?php
// cntnd_language_selector_output

// includes
cInclude('module', 'includes/class.cntnd_language_selector.php');

// assert framework initialization
defined('CON_FRAMEWORK') || die('Illegal call: Missing framework initialization - request aborted.');

// editmode
$editmode = cRegistry::isBackendEditMode();

// input/vars
$activate = (bool) "CMS_VALUE[1]";
$showDisabled = (bool) "CMS_VALUE[2]";

// module
if ($editmode){
    // includes
    cInclude('module', 'includes/style.cntnd_language_selector_output-or-input.php');

	echo '<div class="content_box"><label class="content_type_label">'.mi18n("MODULE").'</label>';
	if (!$activate){
        echo '<div class="cntnd_alert cntnd_alert-primary">'.mi18n("MODULE_DEACTIVATED").'</div>';
    }
}

if ($activate){
    // other/vars
    $cntndOutput = new CntndLanguageSelector($idart, $lang, $client, $showDisabled);
    $languages=$cntndOutput->languages();

    // output
    $tpl = cSmartyFrontend::getInstance();
    $tpl->assign('languages', $languages);
    $tpl->assign('showDisabled', $showDisabled);
    $tpl->display('default.html');
}

if ($editmode){
  echo '</div>';
}
?>