<?php
  define('ABS_PATH', dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/');
  require_once ABS_PATH . 'oc-load.php';

  if(OSP_DEBUG) {
    $emailtext = "status => " . $status . "\r\n";
    $emailtext .= osp_array_to_string(Params::getParamsAsArray());
    mail(osc_contact_email() , 'OSCLASS PAY - PAYHERELK CANCEL DEBUG RESPONSE', $emailtext);
  }

  osc_add_flash_info_message(__('Payment has been canceled', 'osclass_pay'));
  osp_js_redirect_to(osc_base_url());
?>