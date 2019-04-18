<?php

namespace Esgi\Shirt\Model\Team;

use Esgi\Shirt\Model\ResourceModel\Team\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Esgi\Shirt\Model\ResourceModel\Team\Collection
     */
    protected $collection;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $teamCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $teamCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection    = $teamCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Esgi\Shirt\Model\Team $team */
        foreach ($items as $team) {
            $this->loadedData[$team->getId()] = $team->getData();
        }

        $data = $this->dataPersistor->get('shirt_team');

        if (!empty($data)) {
            $team = $this->collection->getNewEmptyItem();
            $team->setData($data);
            $this->loadedData[$team->getId()] = $team->getData();
            $this->dataPersistor->clear('shirt_team');
        }

        return $this->loadedData;
    }
}
