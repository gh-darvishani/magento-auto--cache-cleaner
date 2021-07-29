<?php

namespace Darvishani\CacheCleaner\Cron ;
use Darvishani\CacheCleaner\Helper\Data;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Cache\TypeListInterface;

class CacheCleaner
{

    /**
     * @var TypeListInterface
     */
    private $_cacheTypeList;

    /**
     * @var Data
     */
    private $_helper;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * CacheCleaner constructor.
     * @param TypeListInterface $cacheTypeList
     * @param Data $helper
     * @param LoggerInterface $logger
     */
    public function __construct(
       TypeListInterface $cacheTypeList,
        Data $helper,
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        $this->_helper=$helper;
        $this->_cacheTypeList=$cacheTypeList;
    }

    public function execute() {
         if($this->_helper->isEnable()){
            $invalidateCache=$this->_cacheTypeList->getInvalidated();
            foreach ($invalidateCache as $type){
                $this->_cacheTypeList->cleanType($type['id']);
            }
            if(count($invalidateCache)){
                $this->logger->info(__('%1 invalidate cache cleaned by auto cache cleaner',count($invalidateCache)));
            }
        }

    }
}


