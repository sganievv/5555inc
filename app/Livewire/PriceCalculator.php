<?php

namespace App\Livewire;


use App\Core\Components;
use Exception;

/**
 * Class PriceCalculator.php
 *
 * @package App\Livewire  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 29/10/2023
 */
class PriceCalculator extends Components
{
    public float $quantity = 0.0;
    public float $weight = 0.0;
    public string $unit = 'kg';
    public float $price = 0.0;
    public float  $totalAmount = 0.0;
//    public float $totalValue = 0.0;


    public function changeUnit()
    {
        if($this->unit == 'kg'){
            $this->price = 0.0;
        }
        else{
            $this->price = 0.0;
        }
    }
    public function render()
    {
        try{
            $this->price = max(0.0, $this->price);
        }
        catch (Exception $exception){
            if($this->unit == 'kg'){
                $this->price = 0.0;
            }
            else{
                $this->price = 0.0;
            }
        }
//        try {
//            $this->quantity = (float) max(1, $this->quantity);
//        }catch (Exception $exception){
//            $this->quantity = 0.0;
//        }
        try{
            $this->weight = (float) max(0.0, $this->weight);
        }catch (Exception $exception){
            $this->weight = 0.0;
        }

        try{
            $this->price = (float) max(0.0, $this->price);
        }catch (Exception $exception){
            $this->price = 0.0;
        }

        $this->totalAmount = round($this->weight * $this->price, 4);

//       $this->totalValue = $this->weight / $this->quantity;
//        $this->totalAmount =$this->totalValue * $this->quantity * $this->price;

        return view('livewire.price-calculator');
    }





}
