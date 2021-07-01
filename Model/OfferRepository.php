<?php
namespace DnD\OfferManager\Model;

use DnD\OfferManager\Api\Data\OfferInterface;
use DnD\OfferManager\Api\OfferRepositoryInterface;
use DnD\OfferManager\Model\OfferFactory as OfferModelFactory;

use Magento\Catalog\Model\ImageUploader;

class OfferRepository implements OfferRepositoryInterface
{
    protected $objectFactory;

    protected $offerCategoryResource;

    protected $collectionFactory;

    protected $searchResultsFactory;

    private Offer $offerModel;
    private ImageUploader $imageUploader;
    private ResourceModel\Offer $offerResource;
    private OfferFactory $offerModelFactory;


    public function __construct(
        ImageUploader $imageUploader,
        Offer $offerModel,
        OfferModelFactory $offerFactory,
        \DnD\OfferManager\Model\ResourceModel\Offer $offerResource
    ) {
        $this->imageUploader = $imageUploader;
        $this->offerModel = $offerModel;
        $this->offerModelFactory = $offerFactory;
        $this->offerResource = $offerResource;
    }

    /**
     * @param int $offerId
     * @return OfferInterface
     */
    public function getById(int $offerId)
    {
        $offer = $this->offerModelFactory->create();
        $this->offerResource->load($offer, $offerId);
        return $offer;
    }

    /**
     * @param int $categoryId
     * @return Offer[]
     */
    public function getOffersByCategoryId(int $categoryId)
    {
        $offers = [];
        $connection = $this->offerResource->getConnection();
        $offerIdsSql = $connection->select()
            ->from('dnd_offermanager_offer_category', 'offer_id')
            ->where("category_id = $categoryId")
            ->group('offer_id');
        $offerIds = $connection->fetchAll($offerIdsSql);
        foreach($offerIds as $offerId){
            $offerId = $offerId['offer_id'];
            $offer = $this->offerModelFactory->create();
            $this->offerResource->load($offer, $offerId);
            $offers[] = $offer;
        }
        return $offers;
    }

    /**
     * Saves the new categories for an offer
     *
     * @param $offerData array
     */
    public function save(array $offerData)
    {
        $connection = $this->offerResource->getConnection();
        if('' === $offerData['offer_id']) {
            unset($offerData['offer_id']);
        }

        //simple fields
        $this->offerModel->addData($offerData);

        //save image
        $imageData = $offerData['image'];
        if (isset($imageData[0]['name']) && isset($imageData[0]['tmp_name'])) {
            $imageData = $imageData[0]['name'];
            $image_path = $this->imageUploader->moveFileFromTmp($imageData);
            $this->offerModel->addData([
                'image_name' => $imageData,
                'image_url' => $this->imageUploader->getBasePath() . '/' . $image_path
            ]);
        }
        $this->offerResource->save($this->offerModel);

        //remove previous categories and save the new
        $this->offerResource->getConnection()
            ->delete('dnd_offermanager_offer_category', ['offer_id = ?' => $this->offerModel->getId()]);
        $bulkCategoryInsert = [];
        foreach($offerData['categories'] as $categoryId){
            $bulkCategoryInsert[] = [
                'offer_id' => $this->offerModel->getId(),
                'category_id' => $categoryId
            ];
        }
        $connection->insertMultiple('dnd_offermanager_offer_category', $bulkCategoryInsert);
    }

    public function delete($offerId)
    {
        $offerModel = $this->offerModelFactory->create();
        $this->offerResource->delete($offerModel->setData(['offer_id' => $offerId]));
    }
}
