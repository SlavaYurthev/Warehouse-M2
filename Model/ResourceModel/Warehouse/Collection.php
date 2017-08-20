<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Model\ResourceModel\Warehouse;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {
	protected function _construct() {
		$this->_init(
			'SY\Warehouse\Model\Warehouse',
			'SY\Warehouse\Model\ResourceModel\Warehouse'
		);
	}
}