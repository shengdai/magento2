<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\CatalogInventory\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * CatalogInventory Stock source model
 */
class Stock extends AbstractSource
{
    /**
     * Retrieve option array
     *
     * @return array
     */
    public function getAllOptions()
    {
        return [
            ['value' => \Magento\CatalogInventory\Model\Stock::STOCK_IN_STOCK, 'label' => __('In Stock')],
            ['value' => \Magento\CatalogInventory\Model\Stock::STOCK_OUT_OF_STOCK, 'label' => __('Out of Stock')]
        ];
    }
}