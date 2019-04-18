<?php

declare(strict_types=1);

namespace Esgi\Shirt\Model\ResourceModel\Team;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Esgi\Shirt\Model\Team;
use Esgi\Shirt\Model\ResourceModel\Team as TeamResourceModel;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Team::class, TeamResourceModel::class);
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray($this->_idFieldName, 'title');
    }
}
