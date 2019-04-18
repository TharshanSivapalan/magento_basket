<?php

declare(strict_types=1);

namespace Esgi\Shirt\Api;

/**
 * Esgi shirt CRUD interface.
 * @api
 */
interface ShirtRepositoryInterface
{
    /**
     * Save block.
     *
     * @param \Esgi\Shirt\Api\Data\ShirtInterface $shirt
     * @return \Esgi\Shirt\Api\Data\ShirtInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\ShirtInterface $shirt);

    /**
     * Retrieve $shirt.
     *
     * @param int $shirtId
     * @return \Esgi\Shirt\Api\Data\ShirtInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($shirtId);

    /**
     * Retrieve shirts matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Esgi\Shirt\Api\Data\ShirtSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete shirt.
     *
     * @param \Esgi\Shirt\Api\Data\ShirtInterface $shirt
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\ShirtInterface $shirt);

    /**
     * Delete shirt by ID.
     *
     * @param int $shirtId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($shirtId);
}
