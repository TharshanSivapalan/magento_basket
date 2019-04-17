<?php

declare(strict_types=1);

namespace Esgi\Job\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for job department search results.
 * @api
 */
interface JobSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get departments list.
     *
     * @return \Esgi\Job\Api\Data\JobInterface[]
     */
    public function getItems();

    /**
     * Set departments list.
     *
     * @param \Esgi\Job\Api\Data\JobInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
