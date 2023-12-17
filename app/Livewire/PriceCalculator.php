<?php

namespace App\Livewire;

use App\Core\Components;
use Exception;

class PriceCalculator extends Components
{
    public float $quantity = 0.0;
    public float $weight = 0.0;
    public string $unit = 'kg';
    public float $price = 0.0;
    public float $totalAmount = 0.0;


    public function changeUnit()
    {
        if ($this->unit == 'kg') {
            $this->price = 0.0;
        } else {
            $this->price = 0.0;
        }
    }

    public function render()
    {
        try {
            $this->price = max(0.0, $this->price);
        } catch (Exception $exception) {
            if ($this->unit == 'kg') {
                $this->price = 0.0;
            } else {
                $this->price = 0.0;
            }
        }

        try {
            $this->weight = (float) max(0.0, $this->weight);
        } catch (Exception $exception) {
            $this->weight = 0.0;
        }

        try {
            $this->price = (float) max(0.0, $this->price);
        } catch (Exception $exception) {
            $this->price = 0.0;
        }

        $this->totalAmount = round($this->weight * $this->price, 4);




        return view('livewire.price-calculator');
    }
}
