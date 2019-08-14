<?php
/**
 * Paybox Epayment module for Magento
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * available at : http://opensource.org/licenses/osl-3.0.php
 *
 * @package    Paybox_Epayment
 * @copyright  Copyright (c) 2013-2014 Paybox
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;
$installer->startSetup();
$this->logDebug('E-Transactions status install starting');

// Required tables
$statusTable = $installer->getTable('sales/order_status');
$statusStateTable = $installer->getTable('sales/order_status_state');

 // Insert statuses
$data = array('status' => 'pbxep_partiallypaid', 'label' => 'Paid Partially');
if(!$installer->getConnection()->insertArray($statusTable, array('status', 'label'), $data)){	
	$this->logDebug('E-Transactions status install failed');
}

// Insert states and mapping of statuses to states
$data = array('status' => 'pbxep_partiallypaid','state' => 'processing','is_default' => 1);
if(!$installer->getConnection()->insertArray($statusStateTable, array('status', 'state', 'is_default'), $data)){	
	$this->logDebug('E-Transactions StatusState install failed');
}
$this->logDebug('E-Transactions status install finished');

// Finalization
$installer->endSetup();