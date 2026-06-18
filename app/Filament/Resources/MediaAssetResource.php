<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaAssetResource\Pages;
use App\Models\MediaAsset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class MediaAssetResource extends Resource
{
    protected static ?string $model = MediaAsset::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int    $navigationSort = 50;
    protected static ?string $modelLabel = 'media';
    protected static ?string $pluralModelLabel = 'media library';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->maxLength(255)
                ->helperText('Optional label to find this file later.'),

            Forms\Components\FileUpload::make('path')
                ->label('File')
                ->required()
                ->disk('public')
                ->directory('media-library')
                ->image()
                ->imageEditor()
                ->maxSize(5120)
                ->columnSpanFull(),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('path')->disk('public')->label('Preview')->size(48),
            Tables\Columns\TextColumn::make('title')->searchable()->weight('bold')->placeholder('—'),
            Tables\Columns\TextColumn::make('url')
                ->label('Public URL')
                ->copyable()
                ->copyMessage('URL copied')
                ->color('gray')
                ->limit(50),
            Tables\Columns\TextColumn::make('created_at')->since()->label('Uploaded'),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                // Remove the underlying file too when the record is deleted.
                ->after(fn (MediaAsset $record) => $record->path && Storage::disk('public')->delete($record->path)),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMediaAssets::route('/'),
            'create' => Pages\CreateMediaAsset::route('/create'),
            'edit'   => Pages\EditMediaAsset::route('/{record}/edit'),
        ];
    }
}
