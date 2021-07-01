<?php

namespace DnD\OfferManager\Api;


use DnD\OfferManager\Api\Data\OfferInterface;
use DnD\OfferManager\Model\Offer;

interface OfferRepositoryInterface
{
    /**
     * Get Offer by id
     *
     * @param int|string $offerId
     * @return OfferInterface
     */
    public function getById(int $offerId);

    /**
     * Get offers by category id
     *
     * @param int $categoryId
     * @return Offer[]
     */
    public function getOffersByCategoryId(int $categoryId);

    /**
     * Saves the new categories for an offer
     *
     * @param $offerData array
     */
    public function save(array $offerData);

    /**
     * Deletes the offer
     *
     * @param int|string $offerId
     * @return mixed
     */
    public function delete(int $offerId);
}

