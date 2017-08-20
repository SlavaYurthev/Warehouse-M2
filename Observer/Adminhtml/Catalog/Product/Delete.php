<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Observer\Adminhtml\Catalog\Product;

use Magento\Framework\Event\ObserverInterface;

class Delete implements ObserverInterface {
	protected $helper;
	public function __construct(
		\SY\Warehouse\Helper\Data $helper
	){
		$this->helper = $helper;
	}
	public function execute(\Magento\Framework\Event\Observer $observer){
		$_product = $observer->getProduct();
		$items = $this->helper->getItemsByProductId($_product->getId());
		if($items->count()>0){
			foreach ($items as $item) {
				$item->delete();
			}
		}
	}
}