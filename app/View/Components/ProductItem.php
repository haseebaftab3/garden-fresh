<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductItem extends Component
{
    public $image;
    public $detailsUrl;
    public $wishlistUrl;
    public $cartUrl;
    public $badge;
    public $rating;
    public $reviewsCount;
    public $title;
    public $price;
    public $oldPrice;
    public $id;

    public function __construct($image, $detailsUrl, $wishlistUrl,  $cartUrl, $badge = null, $rating = 0, $reviewsCount = 0, $title, $price, $oldPrice, $id)
    {
        $this->image = $image;
        $this->detailsUrl = $detailsUrl;
        $this->wishlistUrl = $wishlistUrl;
        $this->cartUrl = $cartUrl;
        $this->badge = $badge;
        $this->rating = $rating;
        $this->reviewsCount = $reviewsCount;
        $this->title = $title;
        $this->price = $price;
        $this->oldPrice = $oldPrice;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-item');
    }
}
