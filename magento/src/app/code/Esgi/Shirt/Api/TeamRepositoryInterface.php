<?php

declare(strict_types=1);

namespace Esgi\Shirt\Api;

/**
 * Esgi Shirt CRUD interface.
 * @api
 */
interface TeamRepositoryInterface
{
    /**
     * Save block.
     *
     * @param \Esgi\Shirt\Api\Data\TeamInterface $team
     * @return \Esgi\Shirt\Api\Data\TeamInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\TeamInterface $team);

    /**
     * Retrieve $team.
     *
     * @param int $teamId
     * @return \Esgi\Shirt\Api\Data\TeamInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($teamId);

    /**
     * Retrieve teams matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Esgi\Shirt\Api\Data\TeamSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete team.
     *
     * @param \Esgi\Shirt\Api\Data\TeamInterface $team
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\TeamInterface $team);

    /**
     * Delete team by ID.
     *
     * @param int $teamId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($teamId);
}
