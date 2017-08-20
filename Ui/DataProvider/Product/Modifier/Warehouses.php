<?php
/**
 * Warehouse
 * 
 * @author Slava Yurthev
 */ 
namespace SY\Warehouse\Ui\DataProvider\Product\Modifier;

use \Magento\Catalog\Model\Locator\LocatorInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Store\Api\WebsiteRepositoryInterface;
use \Magento\Store\Api\GroupRepositoryInterface;
use \Magento\Store\Api\StoreRepositoryInterface;
use \Magento\Ui\Component\Form;
use \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class Warehouses extends AbstractModifier {
	protected $locator;
	protected $websiteRepository;
	protected $groupRepository;
	protected $storeRepository;
	protected $websitesOptionsList;
	protected $storeManager;
	protected $websitesList;
	private $dataScopeName;
	private $meta;
	private $collection;
	private $helper;
	private $registry;
	private $product;
	public function __construct(
		LocatorInterface $locator,
		StoreManagerInterface $storeManager,
		WebsiteRepositoryInterface $websiteRepository,
		GroupRepositoryInterface $groupRepository,
		StoreRepositoryInterface $storeRepository,
		\SY\Warehouse\Model\Warehouse $model,
		\SY\Warehouse\Helper\Data $helper,
		\Magento\Framework\Registry $registry,
		$dataScopeName
	) {
		$this->locator = $locator;
		$this->storeManager = $storeManager;
		$this->websiteRepository = $websiteRepository;
		$this->groupRepository = $groupRepository;
		$this->storeRepository = $storeRepository;
		$this->dataScopeName = $dataScopeName;
		$this->helper = $helper;
		$this->registry = $registry;
		$this->product = $registry->registry('current_product');
		$this->meta = [];
		$this->collection = $model->getCollection()->addFieldToFilter('active', 1);
	}
	public function modifyData(array $data) {
		return $data;
	}
	public function modifyMeta(array $meta) {
		if (!$this->storeManager->isSingleStoreMode()) {
			$this->meta['warehouses'] = [
				'arguments' => [
					'data' => [
						'config' => [
							'additionalClasses' => 'admin__fieldset admin__fieldset-product-warehouses',
							'label' => __('Warehouses'),
							'collapsible' => true,
							'componentType' => Form\Fieldset::NAME,
							'sortOrder' => $this->getNextGroupSortOrder(
								$meta,
								'search-engine-optimization',
								40
							),
							'visible' => $this->helper->getIsActive()
						]
					]
				],
				'children' => [
					'use_warehouses' => [
						'arguments' => [
							'data' => [
								'config' => [
									'formElement' => 'select',
									'componentType' => \Magento\Ui\Component\Form\Field::NAME,
									'label' => __('Use Warehouses'),
									'sortOrder' => 0,
									'required' => false,
									'options' => [
										['value'=>0, 'label'=>__('No')],
										['value'=>1, 'label'=>__('Yes')]
									],
									'visible' => true
								]
							]
						]
					]
				]
			];
			if($this->collection->count()>0){
				foreach ($this->collection as $warehouse) {
					$item = $this->helper->getItem($warehouse->getData('id'), $this->product->getId());
					$this->meta['warehouses']['children']['warehouses.'.$warehouse->getData('id')] = [
						'arguments' => [
							'data' => [
								'config' => [
									'componentType' => Form\Fieldset::NAME,
									'label' => $warehouse->getData('title'),
									'collapsible' => true,
									'sortOrder' => ((int)$warehouse->getData('sort'))+1
								]
							]
						],
						'children' => [
							'warehouses.'.$warehouse->getData('id').'.use' => [
								'arguments' => [
									'data' => [
										'config' => [
											'formElement' => 'select',
											'componentType' => \Magento\Ui\Component\Form\Field::NAME,
											'label' => __('Use Warehouse'),
											'required' => false,
											'options' => [
												['value'=>0, 'label'=>__('No')],
												['value'=>1, 'label'=>__('Yes')]
											],
											'value' => (int)$item->getData('use'),
											'sortOrder' => 0,
											'visible' => true
										]
									]
								]
							],
							'warehouses.'.$warehouse->getData('id').'.in_stock' => [
								'arguments' => [
									'data' => [
										'config' => [
											'formElement' => 'select',
											'componentType' => \Magento\Ui\Component\Form\Field::NAME,
											'label' => __('In Stock'),
											'required' => false,
											'options' => [
												['value'=>0, 'label'=>__('No')],
												['value'=>1, 'label'=>__('Yes')]
											],
											'value' => (int)$item->getData('in_stock'),
											'sortOrder' => 1,
											'visible' => true
										]
									]
								]
							],
							'warehouses.'.$warehouse->getData('id').'.qty' => [
								'arguments' => [
									'data' => [
										'config' => [
											'additionalClasses' => 'admin__field-small',
											'formElement' => 'input',
											'componentType' => \Magento\Ui\Component\Form\Field::NAME,
											'label' => __('Qty'),
											'required' => false,
											'value' => (int)$item->getData('qty'),
											'sortOrder' => 2,
											'visible' => true
										]
									]
								]
							]
						]
					];
				}
			}
			$meta = array_replace_recursive(
				$meta,
				$this->meta
			);
		}
		return $meta;
	}
}