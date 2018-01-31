<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Model;

use Chervit\GroupPrice\Api\ProfileRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Chervit\GroupPrice\Model\ResourceModel\Profile as ProfileResource;
use Chervit\GroupPrice\Model\ProfileFactory;


class ProfileRepository implements ProfileRepositoryInterface
{
    /**
     * @var ProfileResource
     */
    protected $resource;

    /**
     * @var \Chervit\GroupPrice\Model\ProfileFactory
     */
    protected $profileFactory;

    /**
     * ProfileRepository constructor.
     * @param ProfileResource $resource
     * @param \Chervit\GroupPrice\Model\ProfileFactory $profileFactory
     */
    public function __construct(
        ProfileResource $resource,
        ProfileFactory $profileFactory
    ) {
        $this->resource                = $resource;
        $this->profileFactory           = $profileFactory;
    }

    /**
     * @param \Chervit\GroupPrice\Api\Data\ProfileInterface $profile
     *
     * @return \Chervit\GroupPrice\Api\Data\ProfileInterface
     * @throws CouldNotSaveException
     */
    public function save(\Chervit\GroupPrice\Api\Data\ProfileInterface $profile)
    {
        try {
            $this->resource->save($profile);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the profile: %1',
                    $exception->getMessage()
                )
            );
        }

        return $profile;
    }

    /**
     * @param $profileId
     *
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($profileId)
    {
        $profile = $this->profileFactory->create();
        $this->resource->load($profile, $profileId);
        if (!$profile->getId()) {
            throw new NoSuchEntityException(__('Profile with id "%1" does not exist.', $profileId));
        }

        return $profile;
    }

    /**
     * @param \Chervit\GroupPrice\Api\Data\ProfileInterface $profile
     *
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Chervit\GroupPrice\Api\Data\ProfileInterface $profile)
    {
        try {
            $this->resource->delete($profile);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __(
                    'Could not delete the profile: %1',
                    $exception->getMessage()
                )
            );
        }

        return true;
    }

    /**
     * @param $profileId
     *
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($profileId)
    {
        return $this->delete($this->getById($profileId));
    }
}
