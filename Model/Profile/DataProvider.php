<?php
/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Model\Profile;

use Chervit\GroupPrice\Model\ResourceModel\Profile\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Chervit\GroupPrice\Api\Data\ProfileInterface;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var \Magento\Framework\Json\DecoderInterface
     */
    protected $jsonDecoder;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $importCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param \Magento\Framework\Json\DecoderInterface $jsonDecoder
     * @param PoolInterface $pool
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $importCollectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\Json\DecoderInterface $jsonDecoder,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        $this->jsonDecoder   = $jsonDecoder;
        $this->collection    = $importCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->pool = $pool;
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
        $items      = $this->collection->getItems();

        foreach ($items as $profile) {
            $data = $profile->getData();
            $this->loadedData[$profile->getId()] = $data;
        }

        $data = $this->dataPersistor->get('profile');

        if (!empty($data)) {
            $job = $this->collection->getNewEmptyItem();
            $job->setData($data);
            $this->loadedData[$profile->getId()] = $job->getData();
            $this->dataPersistor->clear('profile');
        }

        return $this->loadedData;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }

        return $meta;
    }

}
