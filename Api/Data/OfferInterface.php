<?php

namespace DnD\OfferManager\Api\Data;

interface OfferInterface
{
    /**
     * Get Offer id
     *
     * @return int
     */
    public function getId();

    /**
     * Get Offer name
     *
     * @return string
     */
    public function getName();

    /**
     * Get Offer title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get Offer content
     *
     * @return string
     */
    public function getContent();

    /**
     * Get Offer start date
     *
     * @return string
     */
    public function getStartDate();

    /**
     * Get Offer end date
     *
     * @return string
     */
    public function getEndDate();

    /**
     * Get Offer image name
     *
     * @return string
     */
    public function getImageName();

    /**
     * Get Offer image url
     *
     * @return string
     */
    public function getImageUrl();

    /**
     * Get Offer categories
     *
     * @return array
     */
    public function getCategories();

    /**
     * Get Offer redirect url
     *
     * @return string
     */
    public function getRedirectUrl();

    /**
     * Set Offer id
     *
     * @param int $offerId
     * @return int
     */
    public function setId(int $offerId);

    /**
     * Set Offer name
     *
     * @param string $name
     * @return string
     */
    public function setName(string $name);

    /**
     * Set Offer title
     *
     * @param string $title
     * @return string
     */
    public function setTitle(string $title);

    /**
     * Set Offer description
     *
     * @param string $description
     * @return string
     */
    public function setContent(string $description);

    /**
     * Set Offer start date
     *
     * @param string $date
     * @return string
     */
    public function setStartDate(string $date);

    /**
     * Set Offer end date
     *
     * @param string $date
     * @return string
     */
    public function setEndDate(string $date);

    /**
     * Set Offer image name
     *
     * @param string $imageName
     * @return string
     */
    public function setImageName(string $imageName);

    /**
     * Set Offer image url
     *
     * @param string $imageUrl
     * @return string
     */
    public function setImageUrl(string $imageUrl);

    /**
     * Set Offer categories
     *
     * @param array $categoryIds
     * @return mixed
     */
    public function setCategories(array $categoryIds);

    /**
     * Set Offer redirect url
     *
     * @param string $redirectUrl
     * @return mixed
     */
    public function setRedirectUrl(string $redirectUrl);

}
