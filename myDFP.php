<?php
/**
 * Created by PhpStorm.
 * User: umut
 * Date: 10/11/16
 * Time: 14:41
 */




class myDFP
{
    private $config = null;
    private $networkId = null;


    const GOOGLE_GPT_URL = 'https://www.googletagservices.com/tag/js/gpt.js';


    static $errors = array(
        'INVALID_NETWORK_ID'        =>  'Invalid network ID',
        'SLOT_NOT_FOUND'            =>  'Slot not found',
        'SLOT_CODE_NOT_FOUND'            =>  'Slot code not found',
        'SLOT_SIZES_NOT_FOUND'            =>  'Slot sizes not found',
    );

    private $slots = [];


    public function __construct($config)
    {
        $this->config = $config;
    }

    public function init(){
        $this->setNetworkId();
    }

    public function displayAd($placement){
        $slot = $this->getSlot($placement);

        $slotCode = $this->getSlotCode($slot);

        $slotId = (isset($slot['endless']) && $slot['endless'] === true) ? md5($slotCode.rand()) : md5($slotCode);

        $dataAttributes = [];
        $dataAttributes[] = $this->getSlotDataAttribute($slot, 'code');
        $dataAttributes[] = $this->getSlotDataAttribute($slot, 'code');

        $code = '<!-- '.$slot['code'].' -->'."\n";
        $code .= '<div id="'.$slotId.'" data-slot-code="'.$slot['code'].'" data-slot-size="'..'"></div>';

        return $code;
    }

    private function setNetworkId(){
        if (isset($this->config['networkId'])){
            $this->networkId = (string) $this->config['networkId'];
            return true;
        }
        throw new Exception(self::$errors['INVALID_NETWORK_ID']);
    }

    private function getSlot($placement){
        if (isset($this->config['slots'][$placement])){
            return $this->config['slots'][$placement];
        }
        throw new Exception(self::$errors['SLOT_NOT_FOUND']);
    }

    private function getSlotCode($slot){
        if (!empty($slot['code'])){
            return $slot['code'];
        }
        throw new Exception(self::$errors['SLOT_CODE_NOT_FOUND']);
    }

    private function getSlotSizes($slot){
        if (empty($slot['sizes'])){
            throw new Exception(self::$errors['SLOT_SIZES_NOT_FOUND']);
        }
        return implode('|',$slot['sizes']);
    }

    private function getSlotDataAttribute($slot, $name){
        if (!empty($slot[$name])){
            return 'data-slot-'.$name.'="'.$slot[$name].'"';
        }
    }







}