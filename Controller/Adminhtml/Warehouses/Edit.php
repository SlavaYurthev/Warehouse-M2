<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Controller\Adminhtml\Warehouses;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action{
	protected $_coreRegistry = null;
	protected $resultPageFactory;
	public function __construct(
		Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Registry $registry
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry = $registry;
		parent::__construct($context);
	}
	protected function _isAllowed(){
		return $this->_authorization->isAllowed('SY_Warehouse::warehouses');
	}
	protected function _initAction(){
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu('SY_Warehouse::warehouses')
			->addBreadcrumb(__('Warehouses'), __('Warehouses'))
			->addBreadcrumb(__('Edit'), __('Edit'));
		return $resultPage;
	}
	public function execute(){
		$id = $this->getRequest()->getParam('id');
		$model = $this->_objectManager->create('SY\Warehouse\Model\Warehouse');
		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				$resultRedirect = $this->resultRedirectFactory->create();
				return $resultRedirect->setPath('*/*/');
			}
		}
		$data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
		$this->_coreRegistry->register('warehouse', $model);
		$resultPage = $this->_initAction();
		$resultPage->getConfig()->getTitle()->prepend(__('Warehouse'));
		$resultPage->getConfig()->getTitle()->prepend(__('Edit'));
		return $resultPage;
	}
}