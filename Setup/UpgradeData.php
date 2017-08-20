<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface {
	private $eavSetupFactory;
	public function __construct(EavSetupFactory $eavSetupFactory) {
		$this->eavSetupFactory = $eavSetupFactory;
	}
	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
		$setup->startSetup();
		if(version_compare($context->getVersion(), '0.0.4') < 0) {
			$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
			$eavSetup->addAttribute(
				\Magento\Catalog\Model\Product::ENTITY,
				'use_warehouses',
				[
					'type' => 'int',
					'backend' => '',
					'frontend' => '',
					'label' => 'Use Warehouses',
					'input' => 'select',
					'class' => '',
					'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
					'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
					'group' => 'Warehouses',
					'visible' => true,
					'required' => false,
					'user_defined' => false,
					'default' => 0,
					'searchable' => false,
					'filterable' => false,
					'comparable' => false,
					'visible_on_front' => false,
					'used_in_product_listing' => false,
					'unique' => false,
					'apply_to' => ''
				]
			);
		}
		$setup->endSetup();
	}
}