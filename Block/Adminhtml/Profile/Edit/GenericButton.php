<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Block\Adminhtml\Profile\Edit;

use Magento\Backend\Block\Widget\Context;
use Chervit\GroupPrice\Api\ProfileRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var profileRepositoryInterface
     */
    protected $profileRepository;

    /**
     * GenericButton constructor.
     *
     * @param Context                $context
     * @param profileRepositoryInterface $profileRepository
     */
    public function __construct(
        Context $context,
        profileRepositoryInterface $profileRepository
    ) {
        $this->context = $context;
        $this->profileRepository = $profileRepository;
    }

    /**
     * @return null
     */
    public function getProfileId()
    {
        try {
            return $this->profileRepository->getById(
                $this->context->getRequest()->getParam('entity_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
