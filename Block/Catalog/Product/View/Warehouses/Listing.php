<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Block\Catalog\Product\View\Warehouses;

class Listing extends \Magento\Framework\View\Element\Template {
	private $helper;
	private $collection;
	private $product;
	public function __construct(
			\Magento\Framework\View\Element\Template\Context $context,
			\Magento\Framework\Registry $registry,
			\SY\Warehouse\Helper\Data $helper,
			\SY\Warehouse\Model\Warehouse $_warehouse,
			array $data
		){
		$this->helper = $helper;
		$this->product = $registry->registry('product');
		$collection = $_warehouse->getCollection()
			->addFieldToFilter('active', true)->setOrder('sort', 'asc');
		$this->collection = $collection;
		parent::__construct($context, $data);
	}
	public function getHelper(){
		return $this->helper;
	}
	public function getProduct(){
		return $this->product;
	}
	public function getItem($warehouseId = 0){
		return $this->getHelper()->getItem($warehouseId, $this->getProduct()->getId());
	}
	public function getCollection(){
		return $this->collection;
	}
	public function isActive(){
		if($this->helper->getIsActive() && $this->getProduct()->getData('use_warehouses') == "1"){
			return true;
		}
	}
}