<?php
/**
 * @copyleft gh.darvishani
 */


namespace Darvishani\CacheCleaner\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;


class Data extends AbstractHelper
{

    const XML_BASE_CONFIG="darvishani/cache/";


    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    public function isEnable(){
        return $this->getConfig('enable');
    }

    private function getConfig($flag){
        return $this->scopeConfig->getValue(self::XML_BASE_CONFIG.$flag);
    }
}
