<?php

##eloom.licenca##

class Eloom_Yapay_Model_System_Config_Source_Environment {

  public function toOptionArray() {
    return array(
        array(
            'value' => Eloom_Yapay_Domains_Environment::PRODUCTION,
            'label' => Mage::helper('adminhtml')->__('Production')
        ),
        array(
            'value' => Eloom_Yapay_Domains_Environment::SANDBOX,
            'label' => Mage::helper('adminhtml')->__('Sandbox')
        )
    );
  }

}
