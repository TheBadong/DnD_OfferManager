<?php

namespace DnD\OfferManager\Ui\DataProvider\Offer\Form;

use DnD\OfferManager\Model\ResourceModel\Offer as OfferResource;
use DnD\OfferManager\Model\ResourceModel\Offer\Collection as OfferCollection;
use DnD\OfferManager\Model\ResourceModel\Offer\CollectionFactory as OfferCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var string
     */
    private string $_mediaUrl;
    private OfferResource $offerResource;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param OfferCollectionFactory $offerCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        OfferCollectionFactory $offerCollectionFactory,
        OfferResource $offerResource,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->offerResource = $offerResource;
        $this->collection = $offerCollectionFactory->create();
        $this->_mediaUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $offer) {
            $this->loadedData[$offer->getId()]['offer'] = $offer->getData();
            $this->loadedData[$offer->getId()]['offer']['image'][0] = [
                'name' => $offer->getData('image_name'),
                'url' => $this->_mediaUrl . 'dnd_offermanager/offer/' . $offer->getData('image_name')
            ];
            $offerCategories = $this->offerResource->getCategories($offer->getData('offer_id'));
            $this->loadedData[$offer->getId()]['offer']['categories'] = $offerCategories;
        }

        return $this->loadedData;
    }
}
