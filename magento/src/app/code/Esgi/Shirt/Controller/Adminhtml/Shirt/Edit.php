<?php

namespace Esgi\Shirt\Controller\Adminhtml\Shirt;

class Edit extends \Esgi\Shirt\Controller\Adminhtml\Shirt
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context        $context
     * @param \Magento\Framework\Registry                $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit Shirt shirt
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id    = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Esgi\Shirt\Model\Shirt::class);
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This shirt no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('shirt_shirt', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Shirt') : __('New Shirt'),
            $id ? __('Edit Shirt') : __('New Shirt')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Shirts'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getName() : __('New Shirt'));

        return $resultPage;
    }
}
