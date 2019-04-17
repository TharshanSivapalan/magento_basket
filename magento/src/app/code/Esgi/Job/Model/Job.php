<?php

declare(strict_types=1);

namespace Esgi\Job\Model;

use Esgi\Job\Api\Data\JobInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Job extends AbstractModel implements JobInterface, IdentityInterface
{
    /**
     * Esgi Job department cache tag
     */
    const CACHE_TAG = 'esgi_job_j';

    /**#@+
     * Job's statuses
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
    protected $_eventPrefix = 'esgi_job';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'job';

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
        $this->_init(\Esgi\Job\Model\ResourceModel\Job::class);
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
     * Retrieve department id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Retrieve job title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve job type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * Retrieve job location
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
     * Retrieve job content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get department id
     *
     * @return int|null
     */
    public function getDepartmentId()
    {
        return $this->getData(self::DEPARTMENT_ID);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return JobInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return JobInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set type
     *
     * @param string $type
     * @return JobInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Set location
     *
     * @param string $location
     * @return JobInterface
     */
    public function setLocation($location)
    {
        return $this->setData(self::LOCATION, $location);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return JobInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return JobInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set department id
     *
     * @param string $departmentId
     * @return JobInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
    }

    /**
     * Prepare job's statuses.
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
     * @return JobInterface
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
