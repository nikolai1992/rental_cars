<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.01.2022
 * Time: 14:56
 */

namespace App\Filters;

use Carbon\Carbon;

class CarWithDriverFilter extends QueryFilter
{

    public function car_class($car_class="")
    {
        if ($car_class) {
            return $this->builder->where('car_class', $car_class);
        }
    }

    public function city($city)
    {
        if ($city != "all") {
            return $this->builder->where('work_location', $city);
        }
    }

}