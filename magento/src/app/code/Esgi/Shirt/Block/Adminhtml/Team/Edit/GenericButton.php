<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Shirt\Block\Adminhtml\Team\Edit;

use Magento\Backend\Block\Widget\Context;
use Esgi\Shirt\Api\TeamRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
abstract class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var TeamRepositoryInterface
     */
    protected $TeamRepository;

    /**
     * @param Context $context
     * @param TeamRepositoryInterface $TeamRepository
     */
    public function __construct(
        Context $context,
        TeamRepositoryInterface $TeamRepository
    ) {
        $this->context              = $context;
        $this->TeamRepository = $TeamRepository;
    }

    /**
     * Return Shirt team ID
     *
     * @return int|null
     */
    public function getTeamId()
    {
        try {
            return $this->teamRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
