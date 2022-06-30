<?php

namespace App\Filters;

use Carbon\Carbon;

class CarFilter extends \App\Filters\QueryFilter
{
    private $from_date = null;
    private $to_date = null;

    public function from_date($from_date)
    {
        $this->from_date = $from_date;
    }

    public function to_date($to_date)
    {
        $this->to_date = $to_date;
    }

    public function brands($brands)
    {
        $selected_city = isset($_GET["city"]) ? $_GET["city"] : null;
        $selected_car_class = isset($_GET["car_class"]) ? $_GET["car_class"] : null;

        if ($brands) {
            for ($i = 0; $i < count($brands); $i++) {
                if ($i == 0) {
                    $this->builder = $this->builder->where('brand_id', $brands[$i]);
                } else {
                    $this->builder = $this->builder->orWhere('brand_id', $brands[$i])
                        ->where('rent_type', 'simple_rent')
                        ->where('saved', true);
                }

                if ($selected_city) {
                    $this->builder = $this->builder->where('work_location', $selected_city);
                }

                if ($selected_car_class) {
                    $this->builder = $this->builder->where('car_class', $selected_car_class);
                }
            }
        } else {
            if ($selected_city) {
                $this->builder = $this->builder->where('work_location', $selected_city);
            }

            if ($selected_car_class) {
                $this->builder = $this->builder->where('car_class', $selected_car_class);
            }
        }

        return $this->builder;
    }

    public function free_cars($param)
    {
        $time_from = Carbon::parse(Carbon::parse($this->from_date)->format('Y-m-d')." 00:00:00")
            ->format('Y-m-d H:i:s');
        $time_to = Carbon::parse(Carbon::parse($this->to_date)->format('Y-m-d')." 23:59:59")
            ->format('Y-m-d H:i:s');
        return $this->builder->where(function ($query) use ($time_from, $time_to) {
            $query->doesntHave('orders')->orWhereHas('orders', function($q) use ($time_from, $time_to){
                $q->where(function ($query2) use ($time_from, $time_to) {
                    $query2->where('from_date', ">", $time_from)
                        ->where('from_date', ">", $time_to)
                        ->where('to_date', ">", $time_from)
                        ->where('to_date', ">", $time_to);
                })->orWhere(function ($query2) use ($time_from, $time_to) {
                    $query2->where('from_date', "<", $time_from)->where('from_date', "<", $time_to)
                        ->where('to_date', "<", $time_from)
                        ->where('to_date', "<", $time_to);
                });
            });
        });
    }
}