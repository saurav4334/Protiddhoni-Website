<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageSeoResource\Pages;
use App\Models\PageSeo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageSeoResource extends Resource
{
    protected static ?string $model = PageSeo::class;
    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';
    protected static ?string $navigationGroup = 'Marketing site';
    protected static ?int    $navigationSort = 40;
    protected static ?string $modelLabel = 'page SEO';
    protected static ?string $pluralModelLabel = 'page SEO';
    protected static ?string $recordTitleAttribute = 'page';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Page')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('page')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->datalist(['homepage', 'about', 'pricing', 'voice-otp', 'voice-survey',
                                    'voice-broadcast', 'api-docs', 'blog', 'contact', 'user-guide'])
                        ->helperText('Page slug this metadata applies to.'),
                    Forms\Components\TextInput::make('label')
                        ->helperText('Friendly name shown in this list.'),
                ]),

            Forms\Components\Section::make('Search engine')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->maxLength(255)
                        ->helperText('Browser tab + search result title (aim for ≤ 60 chars).'),
                    Forms\Components\Textarea::make('meta_description')
                        ->rows(3)
                        ->maxLength(320)
                        ->helperText('Search result snippet (aim for ≤ 160 chars).'),
                    Forms\Components\TextInput::make('canonical_url')->url(),
                ]),

            Forms\Components\Section::make('Open Graph (social share)')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('og_title')
                        ->label('OG title')
                        ->helperText('Falls back to the SEO title if blank.'),
                    Forms\Components\FileUpload::make('og_image')
                        ->label('OG image')
                        ->image()
                        ->directory('seo')
                        ->disk('public')
                        ->helperText('Recommended 1200×630px.')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('page')->badge()->color('info')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('title')->limit(50)->searchable(),
            Tables\Columns\TextColumn::make('meta_description')->limit(60)->color('gray'),
            Tables\Columns\ImageColumn::make('og_image')->disk('public')->label('OG'),
            Tables\Columns\TextColumn::make('updated_at')->since()->label('Updated'),
        ])
        ->defaultSort('page')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPageSeos::route('/'),
            'create' => Pages\CreatePageSeo::route('/create'),
            'edit'   => Pages\EditPageSeo::route('/{record}/edit'),
        ];
    }
}
