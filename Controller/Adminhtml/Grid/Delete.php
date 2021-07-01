<?php


namespace DnD\OfferManager\Controller\Adminhtml\Grid;

use DnD\OfferManager\Api\OfferRepositoryInterface;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
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
        $offerId = $this->getRequest()->getParam('offer_id');
        $this->offerRepository->delete($offerId);

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DnD_OfferManager::delete');
    }
}
