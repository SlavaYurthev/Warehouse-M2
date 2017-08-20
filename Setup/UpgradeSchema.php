<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface {
	public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$setup->startSetup();
		if(version_compare($context->getVersion(), '0.0.2') < 0) {
			$table = $setup->getConnection()->newTable($setup->getTable('sy_warehouse_item'))
				->addColumn(
					'id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true, 
						'unsigned' => true, 
						'nullable' => false, 
						'primary' => true
					],
					'Id'
				)->addColumn(
					'product_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					255,
					[
						'length' => 255,
						'nullable' => true
					],
					'Product Id'
				)->addColumn(
					'warehouse_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					255,
					[
						'length' => 255,
						'nullable' => true
					],
					'Warehouse Id'
				)->addColumn(
					'use',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					1,
					[
						'default' => "0",
						'nullable' => true
					],
					'Product Id'
				)->addColumn(
					'qty',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					255,
					[
						'default' => "0",
						'length' => 255,
						'nullable' => true
					],
					'Qty'
				)->setComment(
					'Warehouse Item Table'
				);
			$setup->getConnection()->createTable($table);
		}
		if(version_compare($context->getVersion(), '0.0.5') < 0) {
			$setup->getConnection()->addColumn(
				$setup->getTable('sy_warehouse_item'),
				'in_stock',
				[
					'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					'length' => 1,
					'default' => "0",
					'nullable' => true,
					'comment' => 'In Stock'
				]
			);
		}
		$setup->endSetup();
	}
}