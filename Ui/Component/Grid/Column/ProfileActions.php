<?php

/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Ui\Component\Grid\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;


class ProfileActions extends Column
{
    /**
     * Url path
     */
    const URL_PATH_EDIT = 'cher_profile/profile/edit';

    const URL_PATH_DELETE = 'cher_profile/profile/delete';

    const URL_PATH_ENABLE = 'cher_profile/profile/enable';

    const URL_PATH_DISABLE = 'cher_profile/profile/disable';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
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
            foreach ($dataSource['data']['items'] as $id => & $item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.title }"'),
                                'message' => __('Are you sure you want to delete a "${ $.$data.title }" record?')
                            ]
                        ]
                    ];
                    if (!$item['is_active']) {
                        $item[$this->getData('name')]['enable'] = [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_ENABLE,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('Enable')
                        ];
                    } else {
                        $item[$this->getData('name')]['disable'] = [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DISABLE,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('Disable')
                        ];
                    }
                }
            }
        }

        return $dataSource;
    }
}
