<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Model\Warehouse;

use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel {
	protected function _construct() {
		$this->_init('SY\Warehouse\Model\ResourceModel\Warehouse\Item');
	}
}