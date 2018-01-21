<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Api\Data;

interface ProfileInterface
{
    /**
     * @return ProfileInterface
     */
   public function getId();

    /**
     * @return ProfileInterface
     */
   public function getTitle();

    /**
     * @return ProfileInterface
     */
   public function getIsActive();

    /**
     * @return ProfileInterface
     */
   public function getCron();

    /**
     * @return ProfileInterface
     */
   public function getSourceData();

    /**
     * @param $id
     * @return ProfileInterface
     */
   public function setId($id);

    /**
     * @param $title
     * @return ProfileInterface
     */
   public function setTitle($title);

    /**
     * @param $active
     * @return ProfileInterface
     */
   public function setIsActive($active);

    /**
     * @param $cron
     * @return ProfileInterface
     */
   public function setCron($cron);

    /**
     * @param $source
     * @return ProfileInterface
     */
   public function setSourceData($source);
}
