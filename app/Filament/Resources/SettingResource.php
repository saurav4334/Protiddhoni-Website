<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'System';
    protected static ?int    $navigationSort = 90;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')->required()->unique(ignoreRecord: true)->columnSpan(1),
            Forms\Components\TextInput::make('label')->required()->columnSpan(1),
            Forms\Components\TextInput::make('group')->default('general')->datalist(['general','smtp','social','seo','contact'])->columnSpan(1),
            Forms\Components\Select::make('type')->options([
                'string' => 'String', 'json' => 'JSON',
                'boolean' => 'Boolean', 'integer' => 'Integer',
            ])->default('string')->required()->columnSpan(1),
            Forms\Components\Textarea::make('value')->rows(4)->columnSpanFull(),
            Forms\Components\Textarea::make('description')->rows(2)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('group')->badge()->sortable(),
            Tables\Columns\TextColumn::make('key')->fontFamily('mono')->searchable()->copyable(),
            Tables\Columns\TextColumn::make('label')->searchable(),
            Tables\Columns\TextColumn::make('type')->badge()->color('gray'),
            Tables\Columns\TextColumn::make('value')->limit(40),
        ])
        ->defaultSort('group')
        ->filters([
            Tables\Filters\SelectFilter::make('group'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
        ];
    }
}
