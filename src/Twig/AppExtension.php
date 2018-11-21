<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 21/11/18
 * Time: 16:08
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'priceFilter'])
        ];
    }

    public function priceFilter($number)
    {
        return 'R$ '.number_format($number, 2, ',', '.');
    }
}