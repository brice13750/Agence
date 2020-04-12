<?php 

namespace App\Entity;

class AdsFilter{

    private $maxPrice;
    private $minArea;
    

    /**
     * Get the value of maxPrice
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get the value of minArea
     */ 
    public function getMinArea()
    {
        return $this->minArea;
    }

    /**
     * Set the value of minArea
     *
     * @return  self
     */ 
    public function setMinArea($minArea)
    {
        $this->minArea = $minArea;

        return $this;
    }
}