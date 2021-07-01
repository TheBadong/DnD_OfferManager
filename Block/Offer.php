<?php

namespace DnD\OfferManager\Block;

use DnD\OfferManager\Api\OfferRepositoryInterface;

use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class Offer extends Template
{
    private Resolver $layerResolver;
    private OfferRepositoryInterface $offerRepository;


    public function __construct(
        OfferRepositoryInterface $offerRepository,
        Resolver $layerResolver,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->offerRepository = $offerRepository;
        $this->layerResolver = $layerResolver;
    }

    /**
     * Get current category id
     */
    public function getCurrentCategoryId()
    {
        return $this->layerResolver->get()->getCurrentCategory()->getId();
    }

    /**
     * @return \DnD\OfferManager\Model\Offer[]
     */
    public function getOffers()
    {
        $categoryId = $this->getCurrentCategoryId();
        return $this->offerRepository->getOffersByCategoryId($categoryId);
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }


}
