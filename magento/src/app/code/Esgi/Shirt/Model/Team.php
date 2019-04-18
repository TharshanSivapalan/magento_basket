<?php

declare(strict_types=1);

namespace Esgi\Shirt\Model;


use Esgi\Shirt\Api\Data\TeamInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Esgi\Shirt\Model\ResourceModel\Team as TeamResourceModel;

class Team extends AbstractModel implements TeamInterface, IdentityInterface
{
    /**
     * Esgi Shirt team cache tag
     */
    const CACHE_TAG = 'esgi_shirt_team';

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'esgi_shirt';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'team';

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(TeamResourceModel::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve team id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Retrieve team name
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve team content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return TeamInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $title
     * @return TeamInterface
     */
    public function setTitle(string $title): TeamInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return TeamInterface
     */
    public function setContent(string $content): TeamInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Description beforeSave function
     *
     * @return AbstractModel
     */
    public function beforeSave(): AbstractModel
    {
        if ($this->hasDataChanges()) {
            $this->setUpdateTime(null);
        }

        return parent::beforeSave();
    }
}
