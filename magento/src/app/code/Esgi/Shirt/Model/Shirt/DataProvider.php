<?php

namespace Esgi\Shirt\Model\Shirt;

use Esgi\Shirt\Model\ResourceModel\Shirt\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Esgi\Shirt\Model\ResourceModel\Shirt\Collection
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
     * @param CollectionFactory      $shirtCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $shirtCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection    = $shirtCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
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
        /** @var \Esgi\Shirt\Model\Shirt $shirt */
        foreach ($items as $shirt) {
            $this->loadedData[$shirt->getId()] = $shirt->getData();
        }

        $data = $this->dataPersistor->get('shirt_shirt');

        if (!empty($data)) {
            $shirt = $this->collection->getNewEmptyItem();
            $shirt->setData($data);
            $this->loadedData[$shirt->getId()] = $shirt->getData();
            $this->dataPersistor->clear('shirt_shirt');
        }

        return $this->loadedData;
    }
}
