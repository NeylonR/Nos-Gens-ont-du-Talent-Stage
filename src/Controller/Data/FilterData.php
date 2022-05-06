<?php
namespace App\Data;

use App\Entity\Category;

class FilterData
{

    /**
     * @var int
     */
    public int $page = 1;

    /**
     * @var string
     */
    public string $q = '';

    /**
     * @var Category[]
     */
    public array $categories = [];

    /**
     * @var boolean
     */
    public bool $promo = false;

}