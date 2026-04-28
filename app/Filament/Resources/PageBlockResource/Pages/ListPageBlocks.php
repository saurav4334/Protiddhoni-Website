<?php

namespace App\Filament\Resources\PageBlockResource\Pages;

use App\Filament\Resources\PageBlockResource;
use App\Models\PageBlock;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Artisan;

class ListPageBlocks extends ListRecords
{
    protected static string $resource = PageBlockResource::class;

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('viewSite')
                ->label('View website')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url(url('/'))
                ->openUrlInNewTab(),

            Actions\Action::make('seedDefaults')
                ->label('Restore default blocks')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Restore default content blocks?')
                ->modalDescription('This updates or creates the seeded marketing blocks. Existing matching keys will receive the latest default values.')
                ->action(function (): void {
                    Artisan::call('db:seed', [
                        '--class' => 'Database\\Seeders\\PageBlocksSeeder',
                        '--force' => true,
                    ]);

                    Notification::make()
                        ->title('Default content blocks restored')
                        ->success()
                        ->send();
                }),

            Actions\CreateAction::make()
                ->label('New block')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('All')
                ->badge(PageBlock::count()),
        ];

        foreach (PageBlockResource::pageOptions() as $key => $label) {
            $tabs[$key] = Tab::make($label)
                ->badge(PageBlock::where('page', $key)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('page', $key));
        }

        return $tabs;
    }
}
