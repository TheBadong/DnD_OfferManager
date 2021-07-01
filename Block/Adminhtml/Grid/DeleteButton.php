<?php

namespace DnD\OfferManager\Block\Adminhtml\Grid;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    private AuthorizationInterface $authorization;

    public function __construct(
        AuthorizationInterface $authorization,
        RequestInterface $request,
        \Magento\Backend\Block\Widget\Context $context
    ) {
        $this->authorization = $authorization;
        parent::__construct($request, $context);
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        if($this->isAllowed()){
            $data = [];
            if ($this->getId()) {
                $data = [
                    'label' => __('Delete Offer'),
                    'class' => 'delete',
                    'on_click' => 'deleteConfirm(\''
                        . __('Are you sure you want to delete this offer ?')
                        . '\', \'' . $this->getDeleteUrl() . '\')',
                    'sort_order' => 20,
                ];
            }
            return $data;
        } else {
            return [];
        }

    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->_urlBuilder->getUrl('*/*/delete', ['offer_id' => $this->getId()]);
    }

    /**
     * @return bool
     */
    protected function isAllowed()
    {
        return $this->authorization->isAllowed('DnD_OfferManager::delete');
    }
}
