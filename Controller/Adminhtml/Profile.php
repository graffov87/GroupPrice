<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Chervit\GroupPrice\Model\ProfileFactory;
use Chervit\GroupPrice\Api\ProfileRepositoryInterface;

abstract class Profile extends Action
{
    const ADMIN_RESOURCE = 'Chervit_GroupPrice::profile';

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry = null;

    protected $resourceModel;

    /**
     * @var ProfileFactory
     */
    protected $profileFactory;

    /**
     * @var ProfileRepositoryInterface
     */
    protected $repository;

    /**
     * Job constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ProfileFactory $profileFactory
     * @param ProfileRepositoryInterface $repository
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProfileFactory $profileFactory,
        ProfileRepositoryInterface $repository
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->profileFactory = $profileFactory;
        $this->repository = $repository;
        parent::__construct($context);
    }
}
