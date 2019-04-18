<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Esgi\Shirt\Block\Adminhtml\Shirt\Edit;

use Magento\Backend\Block\Widget\Context;
use Esgi\Shirt\Api\ShirtRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var ShirtRepositoryInterface
     */
    protected $shirtRepository;

    /**
     * @param Context $context
     * @param ShirtRepositoryInterface $shirtRepository
     */
    public function __construct(
        Context $context,
        ShirtRepositoryInterface $shirtRepository
    ) {
        $this->context              = $context;
        $this->shirtRepository = $shirtRepository;
    }

    /**
     * Return Shirt shirt ID
     *
     * @return int|null
     */
    public function getShirtId()
    {
        try {
            return $this->shirtRepository->getById(
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
