<?php


namespace DnD\OfferManager\Controller\Adminhtml\Grid;

use DnD\OfferManager\Api\OfferRepositoryInterface;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;


class Edit extends Action
{
    private OfferRepositoryInterface $offerRepository;

    public function __construct(
        OfferRepositoryInterface $offerRepository,
        Context $context
    ) {
        $this->offerRepository = $offerRepository;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $offerData = $this->getRequest()->getParam('offer');
        print_r($offerData);
        if(is_array($offerData)) {
            $this->offerRepository->save($offerData);
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DnD_OfferManager::edit');
    }
}
