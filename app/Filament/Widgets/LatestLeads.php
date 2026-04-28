<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestLeads extends BaseWidget
{
    protected static ?string $heading = 'Latest lead activity';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return ContactSubmission::query()->latest();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('company')
                    ->placeholder('Independent')
                    ->toggleable(),

                Tables\Columns\BadgeColumn::make('interest')
                    ->colors([
                        'info' => 'voice_otp',
                        'success' => 'voice_survey',
                        'warning' => 'voice_broadcast',
                        'gray' => 'other',
                    ]),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'new',
                        'warning' => 'in_review',
                        'info' => 'replied',
                        'success' => 'qualified',
                        'gray' => 'archived',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->label('Open')
                    ->url(fn (ContactSubmission $record): string => route('filament.admin.resources.contact-submissions.view', $record))
                    ->icon('heroicon-o-arrow-top-right-on-square'),
            ])
            ->defaultPaginationPageOption(5);
    }
}
