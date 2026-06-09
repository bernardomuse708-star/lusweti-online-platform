<?php

namespace App\Filament\Resources\Subscribers\Pages;

use App\Filament\Resources\Subscribers\SubscriberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubscriber extends CreateRecord
{
    protected static string $resource = SubscriberResource::class;
}
