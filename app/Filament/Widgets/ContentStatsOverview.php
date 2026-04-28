<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscriber;
use App\Models\PageBlock;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Editable blocks', PageBlock::count())
                ->description(PageBlock::distinct('page')->count('page') . ' site areas connected')
                ->descriptionIcon('heroicon-m-swatch')
                ->color('info'),

            Stat::make('Published posts', BlogPost::where('status', 'published')->count())
                ->description(BlogPost::where('status', 'draft')->count() . ' drafts waiting')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),

            Stat::make('New leads', ContactSubmission::where('status', 'new')->count())
                ->description('Contact form inbox')
                ->descriptionIcon('heroicon-m-inbox')
                ->color('warning'),

            Stat::make('Subscribers', NewsletterSubscriber::where('status', 'subscribed')->count())
                ->description('Active newsletter audience')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary'),
        ];
    }
}
