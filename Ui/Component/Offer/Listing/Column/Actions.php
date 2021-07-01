<?php


namespace DnD\OfferManager\Ui\Component\Offer\Listing\Column;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Actions
 */
class Actions extends Column
{
    private UrlInterface $_urlBuilder;

    public function __construct(
    UrlInterface $url,
    ContextInterface $context,
    UiComponentFactory $uiComponentFactory,
    array $components = [],
    array $data = []
) {
    $this->_urlBuilder = $url;
    parent::__construct($context, $uiComponentFactory, $components, $data);
}

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // here we can also use the data from $item to configure some parameters of an action URL
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->_urlBuilder->getUrl(
                            'dnd_offermanager/grid/edit',
                            ['offer_id' => $item['offer_id']]
                        ),
                        'label' => __('Edit')
                    ]
                ];
            }
        }

        return $dataSource;
    }
}
