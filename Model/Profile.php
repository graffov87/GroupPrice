<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Model;

use Magento\Framework\Model\AbstractModel;

class Profile extends AbstractModel implements \Chervit\GroupPrice\Api\Data\ProfileInterface
{
    /**
     * @return ProfileInterface
     */
    public function getId()
    {
        return $this->getData('entity_id');
    }

    /**
     * @return ProfileInterface
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @return ProfileInterface
     */
    public function getIsActive()
    {
        return $this->getData('is_active');
    }

    /**
     * @return ProfileInterface
     */
    public function getCron()
    {
        return $this->getData('cron');
    }

    /**
     * @return ProfileInterface
     */
    public function getSourceData()
    {
        return $this->getData('source_data');
    }

    /**
     * @param $id
     * @return ProfileInterface
     */
    public function setId($id)
    {
        $this->seData('entity_id', $id);

        return $this;
    }

    /**
     * @param $title
     * @return ProfileInterface
     */
    public function setTitle($title)
    {
        $this->seData('title', $title);

        return $this;
    }

    /**
     * @param $active
     * @return ProfileInterface
     */
    public function setIsActive($active)
    {
        $this->seData('is_active', $active);

        return $this;
    }

    /**
     * @param $cron
     * @return ProfileInterface
     */
    public function setCron($cron)
    {
        $this->seData('cron', $cron);

        return $this;
    }

    /**
     * @param $source
     * @return ProfileInterface
     */
    public function setSourceData($source)
    {
        $this->seData('source_data', $source);

        return $this;
    }
}
