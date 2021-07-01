<?php
namespace DnD\OfferManager\Model;

use DnD\OfferManager\Api\Data\OfferInterface;
use Magento\Framework\Model\AbstractModel;

class Offer extends AbstractModel implements OfferInterface
{
    protected $_cacheTag = 'dnd_offermanager_offer_category';

    protected function _construct()
    {
        $this->_init('DnD\OfferManager\Model\ResourceModel\Offer');
    }

    public function getName()
    {
        return $this->getData('name');
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function getContent()
    {
        return $this->getData('content');
    }

    public function getStartDate()
    {
        return $this->getData('start_date');
    }

    public function getEndDate()
    {
        return $this->getData('end_date');
    }

    public function getImageName()
    {
        return $this->getData('image_name');
    }

    public function getImageUrl()
    {
        return $this->getData('image_url');
    }

    public function getCategories()
    {
        return $this->getData('categories');
    }

    public function getRedirectUrl()
    {
        return $this->getData('redirect_url');
    }

    public function setName(string $name)
    {
        $this->setData('name');
    }

    public function setTitle(string $title)
    {
        $this->setData('title');
    }

    public function setContent(string $description)
    {
        $this->setData('content');
    }

    public function setStartDate(string $date)
    {
        $this->setData('start_date');
    }

    public function setEndDate(string $date)
    {
        $this->setData('end_date');
    }

    public function setImageName(string $imageName)
    {
        $this->setData('image_name');
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->setData('image_url');
    }

    public function setCategories(array $categoryIds)
    {
        $this->setData('categories');
    }

    public function setRedirectUrl(string $redirectUrl)
    {
        $this->setData('redirect_url');
    }
}
