<?php

declare(strict_types=1);

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Esgi\Shirt\Model;

use Esgi\Shirt\Api\ShirtRepositoryInterface;
use Esgi\Shirt\Api\Data;
use Esgi\Shirt\Model\ResourceModel\Shirt as ShirtResource;
use Esgi\Shirt\Model\ResourceModel\Shirt\CollectionFactory as ShirtCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ShirtRepository implements ShirtRepositoryInterface
{
    /**
     * @var ShirtResource
     */
    protected $resource;
    /**
     * @var ShirtFactory
     */
    protected $shirtFactory;
    /**
     * @var ShirtCollectionFactory
     */
    protected $shirtCollectionFactory;
    /**
     * @var Data\ShirtSearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @param ShirtResource                           $resource
     * @param ShirtFactory                            $shirtFactory
     * @param ShirtCollectionFactory                  $shirtCollectionFactory
     * @param Data\ShirtSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ShirtResource $resource,
        ShirtFactory $shirtFactory,
        ShirtCollectionFactory $shirtCollectionFactory,
        Data\ShirtSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource             = $resource;
        $this->shirtFactory           = $shirtFactory;
        $this->shirtCollectionFactory = $shirtCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Shirt data
     *
     * @param \Esgi\Shirt\Api\Data\ShirtInterface $shirt
     *
     * @return Shirt
     * @throws CouldNotSaveException
     */
    public function save(Data\ShirtInterface $shirt)
    {
        try {
            $this->resource->save($shirt);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $shirt;
    }

    /**
     * Load Shirt data by given Shirt Identity
     *
     * @param string $shirtId
     *
     * @return Shirt
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($shirtId)
    {
        $shirt = $this->shirtFactory->create();
        $this->resource->load($shirt, $shirtId);
        if (!$shirt->getId()) {
            throw new NoSuchEntityException(__('Shirt with id "%1" does not exist.', $shirt));
        }

        return $shirt;
    }

    /**
     * Load Shirt data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     *
     * @return \Esgi\Shirt\Api\Data\ShirtSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Esgi\Shirt\Model\ResourceModel\Shirt\Collection $collection */
        $collection = $this->shirtCollectionFactory->create();

        /** @var Data\ShirtSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete Shirt
     *
     * @param \Esgi\Shirt\Api\Data\ShirtInterface $shirt
     *
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\ShirtInterface $shirt)
    {
        try {
            $this->resource->delete($shirt);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Shirt by given Shirt Identity
     *
     * @param string $shirtId
     *
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($shirtId)
    {
        return $this->delete($this->getById($shirtId));
    }
}
