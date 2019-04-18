<?php

declare(strict_types=1);

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Shirt\Model;

use Esgi\Shirt\Api\TeamRepositoryInterface;
use Esgi\Shirt\Api\Data;
use Esgi\Shirt\Model\ResourceModel\Team as TeamResource;
use Esgi\Shirt\Model\TeamFactory;
use Esgi\Shirt\Model\ResourceModel\Team\CollectionFactory as TeamCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BlockRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @var TeamResource
     */
    protected $resource;

    /**
     * @var TeamFactory
     */
    protected $teamFactory;

    /**
     * @var TeamCollectionFactory
     */
    protected $teamCollectionFactory;

    /**
     * @var Data\TeamSearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * @param TeamResource $resource
     * @param TeamFactory $teamFactory
     * @param TeamCollectionFactory $teamCollectionFactory
     * @param Data\TeamSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        TeamResource $resource,
        TeamFactory $teamFactory,
        \Esgi\Shirt\Api\Data\TeamInterfaceFactory $dataTeamFactory,
        TeamCollectionFactory $teamCollectionFactory,
        Data\TeamSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->teamFactory = $teamFactory;
        $this->teamCollectionFactory = $teamCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Team data
     *
     * @param \Esgi\Shirt\Api\Data\TeamInterface team
     * @return Team
     * @throws CouldNotSaveException
     */
    public function save(Data\TeamInterface $team)
    {
        try {
            $this->resource->save($team);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $team;
    }

    /**
     * Load Team data by given Team Identity
     *
     * @param string $teamId
     * @return Team
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($teamId)
    {
        $team = $this->teamFactory->create();
        $this->resource->load($team, $teamId);
        if (!$team->getId()) {
            throw new NoSuchEntityException(__('Team with id "%1" does not exist.', $team));
        }

        return $team;
    }

    /**
     * Load Team data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Esgi\Shirt\Api\Data\TeamSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        /** @var \Esgi\Shirt\Model\ResourceModel\Team\Collection $collection */
        $collection = $this->teamCollectionFactory->create();

        /** @var Data\TeamSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete Team
     *
     * @param \Esgi\Shirt\Api\Data\TeamInterface $team
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(Data\TeamInterface $team)
    {
        try {
            $this->resource->delete($team);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Team by given Team Identity
     *
     * @param string $teamId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($teamId)
    {
        return $this->delete($this->getById($teamId));
    }
}
