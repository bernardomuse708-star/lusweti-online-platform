<?php

namespace App\Observers;

use App\Events\GalleryStreamUpdated;
use App\Models\Gallery;

class GalleryObserver
{
    public function created(Gallery $Gallery): void
    {
        broadcast(new GalleryStreamUpdated($Gallery));
    }

    public function updated(Gallery $Gallery): void
    {
        broadcast(new GalleryStreamUpdated($Gallery));
    }

    public function deleted(Gallery $Gallery): void
    {
        broadcast(new GalleryStreamUpdated($Gallery));
    }
}