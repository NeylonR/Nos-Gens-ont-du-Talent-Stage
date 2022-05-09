<?php
namespace App\Data;

use App\Entity\Category;

class FilterData
{
    /**
     * @var Category[]
     */
    public array $categories = [];

    /**
     * @var boolean
     */
    public bool $agency = true;

    /**
     * @var boolean
     */
    public bool $company = true;
}