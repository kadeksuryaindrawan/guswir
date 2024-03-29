<?php

namespace App;

class Cart
{
    public $items =[];
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $qty){
        $storedItem = ['quantity'=>$qty,'price'=>$item->price*$qty,'item'=>$item,'produk_id'=>$item->id];

        for ($x=0; $x<=count($this->items);$x++){
            if(!array_key_exists($x, $this->items)){
                $item_id=$x;
                break;
            }
        }
        $this->items[$item_id]=$storedItem;
        $this->totalPrice += $item->price*$qty;
        $this->totalQuantity++;
    }

    public function remove($id){
        $this->totalPrice -= $this->items[$id]['item']['price'];
        unset($this->items[$id]);
        $this->totalQuantity--;
    }

}