<?php
// app/code/Esgi/Shirt/Block/Team.php
namespace Esgi\Shirt\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Esgi\Shirt\Model\ResourceModel\Team\Collection;
use Esgi\Shirt\Model\ResourceModel\Team\CollectionFactory;

/**
 * Team block
 */
class Team extends Template
{
    protected $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory,
        Context $context,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getTeams()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        return $collection->getItems();
    }
}
