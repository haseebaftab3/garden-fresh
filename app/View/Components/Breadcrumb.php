<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $homeUrl;
    public $homeLabel;
    public $currentPage;
    public $title;
    public $image;
    public $imageAlt;

    public function __construct($homeUrl = '#', $homeLabel = 'Home', $currentPage, $title, $image, $imageAlt = 'Image')
    {
        $this->homeUrl = $homeUrl;
        $this->homeLabel = $homeLabel;
        $this->currentPage = $currentPage;
        $this->title = $title;
        $this->image = $image;
        $this->imageAlt = $imageAlt;
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}
