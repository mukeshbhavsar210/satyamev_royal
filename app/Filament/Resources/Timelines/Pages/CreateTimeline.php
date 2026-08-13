<?php

namespace App\Filament\Resources\Timelines\Pages;

use App\Filament\Resources\Timelines\TimelineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTimeline extends CreateRecord {
    protected static string $resource = TimelineResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
