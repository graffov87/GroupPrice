<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Controller\Adminhtml\Profile;

use Chervit\GroupPrice\Controller\Adminhtml\Profile as ProfileController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Chervit\GroupPrice\Model\ProfileFactory;
use Chervit\GroupPrice\Api\ProfileRepositoryInterface;

class Index extends ProfileController
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     *
     * @param Context                $context
     * @param Registry               $coreRegistry
     * @param ProfileFactory             $ProfileFactory
     * @param ProfileRepositoryInterface $repository
     * @param PageFactory            $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProfileFactory $profileFactory,
        ProfileRepositoryInterface $repository,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry, $profileFactory, $repository);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Chervit_GroupPrice::profile')
            ->addBreadcrumb(__('Profile'), __('Profile'));
        $resultPage->getConfig()->getTitle()->prepend(__('Profile'));

        return $resultPage;
    }
}
