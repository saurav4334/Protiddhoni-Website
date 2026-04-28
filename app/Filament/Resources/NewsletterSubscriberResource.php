<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Inbox';
    protected static ?int    $navigationSort = 21;
    protected static ?string $modelLabel = 'subscriber';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('name'),
            Forms\Components\TextInput::make('source')->placeholder('blog-sidebar / footer'),
            Forms\Components\Select::make('status')->options([
                'subscribed'   => 'Subscribed',
                'unsubscribed' => 'Unsubscribed',
                'bounced'      => 'Bounced',
            ])->required(),
            Forms\Components\DateTimePicker::make('confirmed_at'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('email')->searchable()->copyable()->weight('bold'),
            Tables\Columns\TextColumn::make('name')->toggleable(),
            Tables\Columns\TextColumn::make('source')->badge()->color('gray'),
            Tables\Columns\BadgeColumn::make('status')->colors([
                'success' => 'subscribed',
                'gray'    => 'unsubscribed',
                'danger'  => 'bounced',
            ]),
            Tables\Columns\TextColumn::make('confirmed_at')->dateTime('M d, Y')->placeholder('—'),
            Tables\Columns\TextColumn::make('created_at')->label('Joined')->since(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'subscribed' => 'Subscribed',
                'unsubscribed' => 'Unsubscribed',
                'bounced' => 'Bounced',
            ]),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('exportCsv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($records) {
                        $csv = "email,name,status,joined\n";
                        foreach ($records as $r) {
                            $csv .= sprintf("%s,%s,%s,%s\n",
                                $r->email, $r->name, $r->status,
                                $r->created_at?->toDateString());
                        }
                        return response()->streamDownload(fn () => print($csv),
                            'subscribers-'.now()->format('Y-m-d').'.csv');
                    }),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletterSubscribers::route('/'),
        ];
    }
}
