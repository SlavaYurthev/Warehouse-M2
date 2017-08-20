<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Controller\Adminhtml\Warehouses;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Delete extends Action {
	protected $_resultPageFactory;
	protected $_resultPage;
	public function __construct(Context $context, PageFactory $resultPageFactory){
		parent::__construct($context);
		$this->_resultPageFactory = $resultPageFactory;
	}
	public function execute(){
		$id = $this->getRequest()->getParam('id');
		if($id>0){
			$model = $this->_objectManager->create('SY\Warehouse\Model\Warehouse');
			$model->load($id);
			try {
				$model->delete();
			} catch (\Exception $e) {
				$this->messageManager->addSuccess(__('Something went wrong.'));
			}
		}
		$this->_redirect('sy_warehouse/warehouses');
	}
	protected function _isAllowed(){
		return $this->_authorization->isAllowed('SY_Warehouse::warehouses');
	}
}