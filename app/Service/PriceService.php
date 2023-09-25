<?php

namespace App\Service;

class PriceService
{
    public function calculatePrice($price): string
    {
        if ($this->isFree($price)) {
            return 'free';
        }

        return number_format(($price / 100), 2, '.');
    }

    private function isFree($price): bool
    {
        return $price === null || $price === 0;
    }
}
