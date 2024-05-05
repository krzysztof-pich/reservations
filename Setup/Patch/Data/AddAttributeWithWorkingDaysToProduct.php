<?php

namespace Pich\Reservations\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddAttributeWithWorkingDaysToProduct implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;
    private EavSetupFactory $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function apply(): void
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(Product::ENTITY, 'working_days', [
            'type' => 'text',
            'label' => 'Working Days',
            'input' => 'multiselect',
            'required' => false,
            'sort_order' => 100,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'backend' => ArrayBackend::class,
            'frontend' => '',
            'class' => '',
            'source' => '',
            'default' => '',
            'is_wysiwyg_enabled' => false,
            'is_html_allowed_on_front' => false,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'apply_to' => 'work_hour_type',
            'option' => [
                'values' => [
                    '1' => 'Monday',
                    '2' => 'Tuesday',
                    '3' => 'Wednesday',
                    '4' => 'Thursday',
                    '5' => 'Friday',
                    '6' => 'Saturday',
                    '7' => 'Sunday'
                ]
            ]
        ]);

        // add attribute to "default" attribute set
        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Product::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Product::ENTITY, $attributeSetId);
        $eavSetup->addAttributeToGroup(Product::ENTITY, $attributeSetId, $attributeGroupId, 'daily_availability', 100);

    }

    public static function getDependencies(): array
    {
        return [AddAttributeToWorkingHourProductType::class];
    }

    public function getAliases(): array
    {
        return [];
    }
}
