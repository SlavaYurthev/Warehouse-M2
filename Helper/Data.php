<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\ObjectManagerInterface;
use \Magento\Framework\App\Helper\Context;
use \Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper {
	private $objectManager;
	public function __construct(
			\Magento\Framework\App\Helper\Context $context,
			\Magento\Framework\ObjectManagerInterface $objectManager
		){
		$this->objectManager = $objectManager;
		parent::__construct($context);
	}
	public function getConfigValue($field, $storeId = null){
		return $this->scopeConfig->getValue('sy_warehouses/'.$field, ScopeInterface::SCOPE_STORE, $storeId);
	}
	public function getIsActive(){
		return (bool)$this->getConfigValue('general/active');
	}
	public function getItem($warehouseId = 0, $productId = 0){
		$collection = $this->objectManager->get('SY\Warehouse\Model\Warehouse\Item')->getCollection();
		$collection->addFieldToFilter('warehouse_id', $warehouseId);
		$collection->addFieldToFilter('product_id', $productId);
		return $collection->getFirstItem();
	}
	public function getItemsByProductId($productId = 0){
		$collection = $this->objectManager->get('SY\Warehouse\Model\Warehouse\Item')->getCollection();
		$collection->addFieldToFilter('product_id', $productId);
		return $collection;
	}
	public function getItemsByWarehouseId($productId = 0){
		$collection = $this->objectManager->get('SY\Warehouse\Model\Warehouse\Item')->getCollection();
		$collection->addFieldToFilter('warehouse_id', $productId);
		return $collection;
	}
}