<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard {
    protected static bool $shouldRegisterNavigation = false;

    public function getWidgets(): array
    {
        
        return [
            
            // Add your own widgets here
        ];
    }
}