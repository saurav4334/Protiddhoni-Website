<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'System';
    protected static ?int    $navigationSort = 80;
    protected static ?string $modelLabel = 'admin user';
    protected static ?string $recordTitleAttribute = 'name';

    /** Only super admins may see / manage admin users. */
    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Account')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')->required()->maxLength(255),
                    Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context) => $context === 'create')
                        ->helperText('Leave blank to keep the current password when editing.'),

                    Forms\Components\Select::make('role')
                        ->options([
                            'super_admin' => 'Super admin',
                            'admin'       => 'Admin',
                            'editor'      => 'Editor',
                            'support'     => 'Support',
                        ])
                        ->default('editor')
                        ->required(),

                    Forms\Components\TextInput::make('avatar_url')
                        ->label('Avatar URL')
                        ->url()
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->helperText('Inactive users cannot log in to the admin panel.'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
            Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
            Tables\Columns\BadgeColumn::make('role')->colors([
                'danger'  => 'super_admin',
                'warning' => 'admin',
                'info'    => 'editor',
                'gray'    => 'support',
            ])->sortable(),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->dateTime('M d, Y')->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('role')->options([
                'super_admin' => 'Super admin', 'admin' => 'Admin',
                'editor' => 'Editor', 'support' => 'Support',
            ]),
            Tables\Filters\TernaryFilter::make('is_active'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                // Never delete yourself or the last remaining super admin.
                ->visible(fn (Admin $record) =>
                    $record->id !== auth()->id()
                    && ! ($record->isSuperAdmin() && Admin::where('role', 'super_admin')->count() <= 1)
                ),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit'   => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
