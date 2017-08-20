<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Model;

use Magento\Framework\Model\AbstractModel;

class Warehouse extends AbstractModel {
	protected function _construct() {
		$this->_init('SY\Warehouse\Model\ResourceModel\Warehouse');
	}
	public function afterDelete(){
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$helper = $objectManager->get('SY\Warehouse\Helper\Data');
		$items = $helper->getItemsByWarehouseId($this->getData('id'));
		if($items->count()>0){
			foreach ($items as $item) {
				$item->delete();
			}
		}
		parent::afterDelete();
	}
}