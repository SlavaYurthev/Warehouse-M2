<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Block\Adminhtml\Warehouses\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
 
class Tabs extends WidgetTabs{
	protected function _construct(){
		parent::_construct();
		$this->setId('warehouses_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Warehouse'));
	}
	protected function _beforeToHtml(){
		$this->addTab(
			'general_data',
			[
				'label' => __('General'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock(
					'SY\Warehouse\Block\Adminhtml\Warehouses\Edit\Tab\General'
				)->toHtml(),
				'active' => true
			]
		);
		return parent::_beforeToHtml();
	}
}