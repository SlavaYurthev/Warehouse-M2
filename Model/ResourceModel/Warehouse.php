<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Warehouse extends AbstractDb {
	protected function _construct() {
		$this->_init('sy_warehouse', 'id');
	}
}