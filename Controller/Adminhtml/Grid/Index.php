<?php

namespace DnD\OfferManager\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;

class Index extends Action
{

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DnD_OfferManager::listing');
    }
}
