<?php

declare(strict_types=1);

namespace Esgi\Shirt\Model;

use Esgi\Shirt\Api\Data\ShirtInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Shirt extends AbstractModel implements ShirtInterface, IdentityInterface
{
    /**
     * Esgi Shirt team cache tag
     */
    const CACHE_TAG = 'esgi_shirt_shirt';

    /**#@+
     * Shirt's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

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
    protected $_eventObject = 'shirt';

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
        $this->_init(\Esgi\Shirt\Model\ResourceModel\Shirt::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
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
     * Retrieve shirt title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve shirt type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * Retrieve shirt location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->getData(self::LOCATION);
    }

    /**
     * Is active
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * Retrieve shirt content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get team id
     *
     * @return int|null
     */
    public function getTeamId()
    {
        return $this->getData(self::TEAM_ID);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return ShirtInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ShirtInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set type
     *
     * @param string $type
     * @return ShirtInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Set location
     *
     * @param string $location
     * @return ShirtInterface
     */
    public function setLocation($location)
    {
        return $this->setData(self::LOCATION, $location);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return ShirtInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ShirtInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set team id
     *
     * @param string $teamId
     * @return ShirtInterface
     */
    public function setTeamId($teamId)
    {
        return $this->setData(self::TEAM_ID, $teamId);
    }

    /**
     * Prepare shirt's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return ShirtInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Retrieve block update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
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
