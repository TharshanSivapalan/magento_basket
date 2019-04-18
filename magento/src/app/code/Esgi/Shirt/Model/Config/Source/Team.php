<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Esgi\Shirt\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Esgi\Shirt\Model\ResourceModel\Team\Collection;
use Esgi\Shirt\Model\ResourceModel\Team\CollectionFactory;

/**
 * Options provider for countries list
 *
 * @api
 * @since 100.0.2
 */
class Team implements ArrayInterface
{
    /**
     * Countries
     *
     * @var CollectionFactory $teamCollectionFactory
     */
    protected $teamCollectionFactory;

    /**
     * Options array
     *
     * @var array
     */
    protected $options;

    /**
     * Team constructor
     *
     * @param CollectionFactory $teamCollectionFactory
     */
    public function __construct(
        CollectionFactory $teamCollectionFactory
    )
    {
        $this->teamCollectionFactory = $teamCollectionFactory;
    }

    /**
     * Return options array
     *
     * @param boolean $isMultiselect
     * @return array
     */
    public function toOptionArray($isMultiselect = false): array
    {
        if (!$this->options) {
            /** @var Collection $collection */
            $collection = $this->teamCollectionFactory->create();
            $this->options = $collection->toOptionArray();
        }

        $options = $this->options;
        if (!$isMultiselect) {
            array_unshift($options, ['value' => '', 'label' => __('--Please Select--')]);
        }

        return $options;
    }
}
