<?php
namespace DnD\OfferManager\Model\ResourceModel\Offer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'offer_id';

    protected function _construct()
    {
        $this->_init('DnD\OfferManager\Model\Offer', 'DnD\OfferManager\Model\ResourceModel\Offer');
    }

}
