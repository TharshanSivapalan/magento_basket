<?php

declare(strict_types=1);

namespace Esgi\Shirt\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Shirt extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('esgi_shirt_shirt', 'entity_id');
    }
}
