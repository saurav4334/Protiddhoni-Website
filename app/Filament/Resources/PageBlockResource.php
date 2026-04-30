<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageBlockResource\Pages;
use App\Models\PageBlock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageBlockResource extends Resource
{
    protected static ?string $model = PageBlock::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'Marketing site';
    protected static ?int    $navigationSort = 30;
    protected static ?string $recordTitleAttribute = 'label';
    protected static ?string $modelLabel = 'page block';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Identification')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('label')
                        ->required()
                        ->helperText('Human-friendly name shown in the CMS list.')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('key')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Used by the marketing site to fetch this block (e.g. homepage.hero.headline).')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('page')
                        ->required()
                        ->datalist(['homepage', 'voice-otp', 'voice-survey', 'voice-broadcast',
                                    'pricing', 'about', 'contact', 'global'])
                        ->helperText('Which page this block belongs to.'),

                    Forms\Components\Select::make('type')
                        ->options([
                            'text'      => 'Plain text',
                            'rich_text' => 'Rich text (HTML)',
                            'json'      => 'JSON (structured)',
                            'image'     => 'Image URL',
                        ])
                        ->default('text')
                        ->required()
                        ->live(),

                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                ]),

            Forms\Components\Section::make('Content')->schema([
                Forms\Components\Textarea::make('value')
                    ->rows(3)
                    ->visible(fn ($get) => $get('type') === 'text')
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('value')
                    ->visible(fn ($get) => $get('type') === 'rich_text')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('value')
                    ->rows(8)
                    ->placeholder('{"items": [...]}')
                    ->visible(fn ($get) => $get('type') === 'json')
                    ->helperText('Valid JSON. Used for structured data like FAQ lists, testimonials, pricing tiers.')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('value')
                    ->image()
                    ->directory('page-blocks')
                    ->visible(fn ($get) => $get('type') === 'image')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->rows(2)
                    ->helperText('Editor hint — when does this block show? What\'s the recommended format?')
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('page')->badge()->color('info')->sortable(),
            Tables\Columns\TextColumn::make('label')->searchable()->weight('bold'),
            Tables\Columns\TextColumn::make('key')->fontFamily('mono')->copyable()->color('gray'),
            Tables\Columns\BadgeColumn::make('type')->colors([
                'gray'    => 'text',
                'info'    => 'rich_text',
                'warning' => 'json',
                'success' => 'image',
            ]),
            Tables\Columns\TextColumn::make('updated_at')->since()->label('Updated'),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('page'),
            Tables\Filters\SelectFilter::make('type')->options([
                'text' => 'Text', 'rich_text' => 'Rich text',
                'json' => 'JSON', 'image' => 'Image',
            ]),
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
            'index' => Pages\ListPageBlocks::route('/'),
        ];
    }
}
