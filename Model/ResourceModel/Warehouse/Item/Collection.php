<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Model\ResourceModel\Warehouse\Item;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
	protected function _construct() {
		$this->_init(
			'SY\Warehouse\Model\Warehouse\Item',
			'SY\Warehouse\Model\ResourceModel\Warehouse\Item'
		);
	}
}