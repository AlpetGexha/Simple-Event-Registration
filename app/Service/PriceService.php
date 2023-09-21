<?php

namespace App\Service;

class PriceService
{
    public function calculatePrice($price)
    {
        if ($this->isFree($price)) {
            return 'free';
        }

        return number_format(($price / 100), 2, '.');
    }

    private function isFree($price)
    {
        return $price === null || $price === 0;
    }
}
