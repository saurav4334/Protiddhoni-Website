<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Inbox';
    protected static ?int    $navigationSort = 20;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Submission')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')->disabled(),
                    Forms\Components\TextInput::make('email')->disabled(),
                    Forms\Components\TextInput::make('company')->disabled(),
                    Forms\Components\TextInput::make('phone')->disabled(),
                    Forms\Components\TextInput::make('industry')->disabled(),
                    Forms\Components\TextInput::make('expected_volume')->disabled(),
                    Forms\Components\TextInput::make('interest')->disabled(),
                    Forms\Components\Textarea::make('message')->disabled()->rows(4)->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Triage')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('status')->options([
                        'new'        => 'New',
                        'in_review'  => 'In review',
                        'replied'    => 'Replied',
                        'qualified'  => 'Qualified lead',
                        'archived'   => 'Archived',
                    ])->required(),

                    Forms\Components\Select::make('assigned_to')
                        ->label('Assigned to')
                        ->relationship('assignee', 'name')
                        ->searchable()
                        ->preload(),

                    Forms\Components\Textarea::make('internal_notes')
                        ->rows(3)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('created_at')
                ->label('Received')
                ->since()
                ->sortable(),

            Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
            Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
            Tables\Columns\TextColumn::make('company')->toggleable(),

            Tables\Columns\BadgeColumn::make('interest')
                ->colors([
                    'info'    => 'voice_otp',
                    'success' => 'voice_survey',
                    'warning' => 'voice_broadcast',
                    'gray'    => 'other',
                ]),

            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'danger'  => 'new',
                    'warning' => 'in_review',
                    'info'    => 'replied',
                    'success' => 'qualified',
                    'gray'    => 'archived',
                ])
                ->sortable(),

            Tables\Columns\TextColumn::make('assignee.name')->label('Assigned'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')->options([
                'new' => 'New', 'in_review' => 'In review',
                'replied' => 'Replied', 'qualified' => 'Qualified',
                'archived' => 'Archived',
            ]),
            Tables\Filters\SelectFilter::make('interest')->options([
                'voice_otp' => 'Voice OTP', 'voice_survey' => 'Surveys',
                'voice_broadcast' => 'Broadcast', 'other' => 'Other',
            ]),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getNavigationBadge(): ?string
    {
        $count = ContactSubmission::where('status', 'new')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'view'  => Pages\ViewContactSubmission::route('/{record}'),
            'edit'  => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
