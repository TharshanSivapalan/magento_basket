<?php

namespace Esgi\Shirt\Controller\Adminhtml\Shirt;

use Magento\Backend\App\Action\Context;
use Esgi\Shirt\Model\Shirt;
use Esgi\Shirt\Model\ShirtFactory;
use Esgi\Shirt\Model\ResourceModel\Shirt as ShirtResourceModel;
use Esgi\Shirt\Api\ShirtRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Esgi\Shirt\Controller\Adminhtml\Shirt
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * Description $shirtRepository field
     *
     * @var ShirtRepositoryInterface $shirtRepository
     */
    protected $shirtRepository;
    /**
     * Description $shirtFactory field
     *
     * @var ShirtFactory $shirtFactory
     */
    protected $shirtFactory;
    /**
     * Description $shirtResourceModel field
     *
     * @var ShirtResourceModel $shirtResourceModel
     */
    protected $shirtResourceModel;

    /**
     * Save constructor
     *
     * @param Context                       $context
     * @param \Magento\Framework\Registry   $coreRegistry
     * @param DataPersistorInterface        $dataPersistor
     * @param ShirtRepositoryInterface $shirtRepository
     * @param ShirtFactory             $shirtFactory
     * @param ShirtResourceModel       $shirtResourceModel
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        ShirtRepositoryInterface $shirtRepository,
        ShirtFactory $shirtFactory,
        ShirtResourceModel $shirtResourceModel
    ) {
        parent::__construct($context, $coreRegistry);

        $this->dataPersistor           = $dataPersistor;
        $this->shirtRepository    = $shirtRepository;
        $this->shirtFactory       = $shirtFactory;
        $this->shirtResourceModel = $shirtResourceModel;
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data           = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            /** @var Shirt $model */
            $model = $this->shirtFactory->create();

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                try {
                    $model = $this->shirtRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This shirt no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->shirtRepository->save($model);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the shirt.'));
            }

            $this->dataPersistor->set('shirt_shirt', $data);

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
