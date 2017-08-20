<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */
namespace SY\Warehouse\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface {
	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
		$setup->startSetup();

		$table = $setup->getConnection()->newTable($setup->getTable('sy_warehouse'))
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
				'title',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				[
					'nullable' => true
				],
				'Title'
			)->addColumn(
				'description',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				null,
				[
					'nullable' => true
				],
				'Description'
			)->addColumn(
				'image',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				[
					'nullable' => true
				],
				'Image'
			)->addColumn(
				'location',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				255,
				[
					'nullable' => true
				],
				'Location'
			)->addColumn(
				'active',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				1,
				[
					'nullable' => true,
					'default' => '1'
				],
				'Active'
			)->addColumn(
				'sort',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				1,
				[
					'nullable' => true,
					'default' => '0'
				],
				'Sort'
			)->setComment(
				'Slider Table'
			);
		$setup->getConnection()->createTable($table);

		$setup->endSetup();
	}
}