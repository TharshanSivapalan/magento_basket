<?php

declare(strict_types=1);

namespace Esgi\Shirt\Api\Data;

/**
 * Esgi team interface.
 *
 * @api
 */
interface TeamInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'entity_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string|null
     */
    public function getTitle(): string;

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent(): string;

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return TeamInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $title
     *
     * @return TeamInterface
     */
    public function setTitle(string $title): TeamInterface;

    /**
     * Set content
     *
     * @param string $content
     *
     * @return TeamInterface
     */
    public function setContent(string $content): TeamInterface;
}
