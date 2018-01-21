<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Api;

interface ProfileRepositoryInterface
{
    /**
     * Save profile.
     *
     * @param \Chervit\GroupPrice\Api\Data\ProfileInterface $profile
     * @return \Chervit\GroupPrice\Api\Data\ProfileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\ProfileInterface $profile);

    /**
     * Retrieve profile.
     *
     * @param int $profileId
     * @return \Chervit\GroupPrice\Api\Data\ProfileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($profileId);

    /**
     * Delete profile.
     *
     * @param \Chervit\GroupPrice\Api\Data\ProfileInterface $profile
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\ProfileInterface $profile);

    /**
     * Delete profile by ID.
     *
     * @param int $profileId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($profileId);
}
