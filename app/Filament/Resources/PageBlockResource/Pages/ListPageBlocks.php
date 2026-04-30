<?php

namespace App\Filament\Resources\PageBlockResource\Pages;

use App\Filament\Resources\PageBlockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPageBlocks extends ListRecords
{
    protected static string $resource = PageBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New block'),
        ];
    }
}
