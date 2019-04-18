<?php

declare(strict_types=1);

namespace Esgi\Shirt\Api\Data;

/**
 * Esgi Shirt interface.
 *
 * @api
 */
interface ShirtInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'entity_id';
    const TITLE = 'title';
    const TYPE = 'type';
    // const LOCATION = 'location';
    const IS_ACTIVE = 'is_active';
    const CONTENT = 'content';
    const TEAM_ID = 'team_id';
    const UPDATE_TIME   = 'update_time';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType();

    /**
     * Get location
     *
     * @return string|null
     */
    // public function getLocation();

    /**
     * Get date
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get department id
     *
     * @return int|null
     */
    public function getDepartmentId();

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return ShirtInterface
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ShirtInterface
     */
    public function setTitle($title);

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ShirtInterface
     */
    public function setType($type);

    /**
     * Set location
     *
     * @param string $location
     *
     * @return ShirtInterface
     */
    // public function setLocation($location);

    /**
     * Set update time
     *
     * @param string $updateTime
     *
     * @return ShirtInterface
     */
    public function setUpdateTime($updateTime);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     *
     * @return ShirtInterface
     */
    public function setIsActive($isActive);

    /**
     * Set content
     *
     * @param string $content
     *
     * @return ShirtInterface
     */
    public function setContent($content);

    /**
     * Set department id
     *
     * @param string $teamId
     *
     * @return ShirtInterface
     */
    public function setTeamId($teamId);
}
