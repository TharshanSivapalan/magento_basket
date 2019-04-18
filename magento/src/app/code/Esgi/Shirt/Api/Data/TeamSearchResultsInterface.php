<?php

declare(strict_types=1);

namespace Esgi\Shirt\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for shirt team search results.
 * @api
 */
interface TeamSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get departments list.
     *
     * @return \Esgi\Shirt\Api\Data\TeamInterface[]
     */
    public function getItems();

    /**
     * Set departments list.
     *
     * @param \Esgi\Shirt\Api\Data\TeamInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
