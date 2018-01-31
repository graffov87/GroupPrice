<?php

/**
 * @author   : Vitaliy Charnou <graffov87@gmail.com>
 */

namespace Chervit\GroupPrice\Ui\Component\Listing\Column\Isactive;

use Magento\Framework\Data\OptionSourceInterface;
class Options implements OptionSourceInterface
{

    const STATUS_ENABLED    = 1;

    const STATUS_DISABLED   = 0;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions =  [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}
