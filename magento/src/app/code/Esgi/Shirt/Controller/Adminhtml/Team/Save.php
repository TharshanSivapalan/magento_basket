<?php

namespace Esgi\Shirt\Controller\Adminhtml\Team;

use Magento\Backend\App\Action\Context;
use Esgi\Shirt\Model\Team;
use Esgi\Shirt\Model\TeamFactory;
use Esgi\Shirt\Model\ResourceModel\Team as TeamResourceModel;
use Esgi\Shirt\Api\TeamRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Esgi\Shirt\Controller\Adminhtml\Team
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * Description $teamRepository field
     *
     * @var TeamRepositoryInterface $teamRepository
     */
    protected $teamRepository;
    /**
     * Description $teamFactory field
     *
     * @var TeamFactory $teamFactory
     */
    protected $teamFactory;
    /**
     * Description $teamResourceModel field
     *
     * @var TeamResourceModel $teamResourceModel
     */
    protected $teamResourceModel;

    /**
     * Save constructor
     *
     * @param Context                       $context
     * @param \Magento\Framework\Registry   $coreRegistry
     * @param DataPersistorInterface        $dataPersistor
     * @param TeamRepositoryInterface $teamRepository
     * @param TeamFactory             $teamFactory
     * @param TeamResourceModel       $teamResourceModel
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        TeamRepositoryInterface $teamRepository,
        TeamFactory $teamFactory,
        TeamResourceModel $teamResourceModel
    ) {
        parent::__construct($context, $coreRegistry);

        $this->dataPersistor           = $dataPersistor;
        $this->teamRepository    = $teamRepository;
        $this->teamFactory       = $teamFactory;
        $this->teamResourceModel = $teamResourceModel;
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

            /** @var Team $model */
            $model = $this->teamFactory->create();

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                try {
                    $model = $this->teamRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This team no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->teamRepository->save($model);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the team.'));
            }

            $this->dataPersistor->set('shirt_team', $data);

            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
