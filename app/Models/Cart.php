<?php

namespace App\Models;



class Cart
{
    public $items=null;
    public $totalQty=0;
    public $totalPrice=0;
    public $shop=0;
    public function __construct($oldcart)
    {
        if($oldcart)
        {
            $this->items=$oldcart->items;
            $this->totalQty=$oldcart->totalQty;
            $this->totalPrice=$oldcart->totalPrice;
            $this->shop=$oldcart->shop;
        }
        
    }
    public function add($item,$id,$shop)
    {
        $storedItem=['qty'=>0,'price'=>$item->selling_price,'item'=>$item];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem=$this->items[$id];
            }
        }
      
        $storedItem['qty']++;
        $storedItem['price']=$item->selling_price* $storedItem['qty'];
        $this->items[$id]=$storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->selling_price;
        $this->shop=$shop;
    }
    public function reduce($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price']-=$this->items[$id]['item']['selling_price'];
        $this->totalQty--;
        $this->totalPrice-=$this->items[$id]['item']['selling_price'];
        if($this->items[$id]['qty']<=0){
            unset($this->items[$id]);
        }
    }
    public function remove($id)
    {
        $this->totalQty-=$this->items[$id]['qty'];
        $this->totalPrice-=$this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
