<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Observer\Adminhtml\Catalog\Product;

use Magento\Framework\Event\ObserverInterface;

class Save implements ObserverInterface {
	protected $request;
	protected $objectManager;
	protected $helper;
	public function __construct(
		\Magento\Framework\App\Request\Http $request,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\SY\Warehouse\Helper\Data $helper
    ){
		$this->request = $request;
		$this->helper = $helper;
		$this->objectManager = $objectManager;
    }
    public function getRequest() {
    	return $this->request;
    }
	public function execute(\Magento\Framework\Event\Observer $observer){
		if($this->getRequest()->getModuleName() == 'catalog' &&
			$this->getRequest()->getControllerName() == 'product' &&
			$this->getRequest()->getActionName() == 'save' &&
			$this->helper->getIsActive()){
			$_product = $observer->getProduct();
			$product = $this->getRequest()->getParam('product');
			if(isset($product['warehouses'])){
				if(count($product['warehouses'])>0){
					foreach ($product['warehouses'] as $warehouseId => $data) {
						$item = $this->helper->getItem($warehouseId, $_product->getId());
						$item->addData(['product_id' => $_product->getId(), 'warehouse_id' => $warehouseId]);
						$item->addData($data);
						$item->save();
					}
				}
			}
		}
	}
}