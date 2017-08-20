<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Model\ResourceModel\Warehouse;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Item extends AbstractDb {
	protected function _construct() {
		$this->_init('sy_warehouse_item', 'id');
	}
}