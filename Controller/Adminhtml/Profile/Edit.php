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
use Magento\Framework\Controller\ResultFactory;

class Edit extends ProfileController
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Edit constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ProfileFactory $profileFactory
     * @param ProfileRepositoryInterface $repository
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProfileFactory $profileFactory,
        ProfileRepositoryInterface $repository,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry, $profileFactory, $repository);
    }

    /**
     * @return $this|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $jobId = $this->getRequest()->getParam('entity_id');
        $model = $this->profileFactory->create();
        if ($jobId) {
            $model = $this->repository->getById($jobId);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This profile is no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->coreRegistry->register('cher_profile', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Chervit_GroupPrice::profile');
        $resultPage->getConfig()->getTitle()->prepend(__('Profiles'));
        $resultPage->addBreadcrumb(__('Profile'), __('Profile'));
        $resultPage->addBreadcrumb(
            $jobId ? __('Edit Profile') : __('New Profile'),
            $jobId ? __('Edit Profile') : __('New Profile')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Profiles'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Profiles'));

        return $resultPage;
    }
}
