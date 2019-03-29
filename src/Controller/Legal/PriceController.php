<?php

namespace Controller\Legal;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class PriceController
 * @package Controller\Legal
 */
class PriceController extends AbstractController
{
    private $legalTexts = array(
        "da_DK" => array(
            "price_cash" => "%engine_size% yalla"
        ),
        "se_SV" => array(
            "price_cash" => "%engine_size% yalla"
        ),
    );

    protected function replaceValues($text, $values)
    {
        $output = array();
        return $output;
    }

    public function get($data)
    {
        $text = $this->legalTexts[$data['locale']['price_type']];
        $legal = $this->replaceValues($text, $data['attributes']);
        return $legal;
    }
}