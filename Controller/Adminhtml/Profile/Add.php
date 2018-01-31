<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Controller\Adminhtml\Profile;

use Chervit\GroupPrice\Controller\Adminhtml\Profile as ProfileController;
use Chervit\GroupPrice\Model\ProfileFactory;
use Chervit\GroupPrice\Api\ProfileRepositoryInterface;

class Add extends ProfileController
{
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * Add constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param ProfileFactory $profileFactory
     * @param ProfileRepositoryInterface $repository
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        ProfileFactory $profileFactory,
        ProfileRepositoryInterface $repository,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context, $coreRegistry, $profileFactory, $repository);
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
