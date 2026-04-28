<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageBlockResource\Pages;
use App\Models\PageBlock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class PageBlockResource extends Resource
{
    protected static ?string $model = PageBlock::class;
    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationGroup = 'Marketing site';
    protected static ?int $navigationSort = 30;
    protected static ?string $recordTitleAttribute = 'label';
    protected static ?string $modelLabel = 'content block';
    protected static ?string $pluralModelLabel = 'content studio';

    public static function pageOptions(): array
    {
        return [
            'global' => 'Global',
            'homepage' => 'Homepage',
            'voice-otp' => 'Voice OTP',
            'voice-survey' => 'Voice Survey',
            'voice-broadcast' => 'Voice Broadcast',
            'pricing' => 'Pricing',
            'about' => 'About',
            'contact' => 'Contact',
            'api-docs' => 'API Docs',
            'blog' => 'Blog',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Where this content appears')
                ->description('Each block maps to a visible piece of the Laravel marketing site through data-cms attributes.')
                ->columns(3)
                ->schema([
                    Forms\Components\Select::make('page')
                        ->required()
                        ->options(static::pageOptions())
                        ->searchable()
                        ->live()
                        ->helperText('Group blocks by the page they update.'),

                    Forms\Components\Select::make('type')
                        ->options([
                            'text' => 'Plain text',
                            'rich_text' => 'Rich text / HTML',
                            'json' => 'Structured JSON',
                            'image' => 'Image URL / upload',
                            'boolean' => 'Toggle',
                            'integer' => 'Number',
                        ])
                        ->default('text')
                        ->required()
                        ->live()
                        ->helperText('The renderer uses this to cast values correctly.'),

                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->helperText('Lower numbers appear first in this CMS list.'),

                    Forms\Components\TextInput::make('label')
                        ->required()
                        ->helperText('Human-friendly name for editors.'),

                    Forms\Components\TextInput::make('key')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Example: homepage.hero.headline')
                        ->columnSpan(2),

                    Forms\Components\Placeholder::make('preview')
                        ->label('Preview target')
                        ->content(fn ($get) => new HtmlString(
                            '<a class="text-primary-600 font-semibold" target="_blank" rel="noreferrer" href="' .
                            e(static::previewUrl((string) $get('page'))) .
                            '">Open related page</a>'
                        ))
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Editable value')
                ->description('Use the matching field for this block type. Static fallback remains on the public page if a block is empty.')
                ->schema([
                    Forms\Components\Textarea::make('value')
                        ->label('Text')
                        ->rows(4)
                        ->visible(fn ($get) => $get('type') === 'text')
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('value')
                        ->label('Rich content')
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'bulletList',
                            'orderedList',
                            'link',
                            'undo',
                            'redo',
                        ])
                        ->visible(fn ($get) => $get('type') === 'rich_text')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('value')
                        ->label('JSON')
                        ->rows(12)
                        ->placeholder('[{"q":"Question","a":"Answer"}]')
                        ->visible(fn ($get) => $get('type') === 'json')
                        ->rules(['nullable', 'json'])
                        ->helperText('Valid JSON only. Used for FAQ lists, testimonials, pricing tiers, team members, and repeatable cards.')
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('value')
                        ->label('Image')
                        ->image()
                        ->directory('page-blocks')
                        ->visible(fn ($get) => $get('type') === 'image')
                        ->columnSpanFull(),

                    Forms\Components\Toggle::make('value')
                        ->label('Enabled')
                        ->visible(fn ($get) => $get('type') === 'boolean')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('value')
                        ->label('Number')
                        ->numeric()
                        ->visible(fn ($get) => $get('type') === 'integer')
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('description')
                        ->label('Editor note')
                        ->rows(2)
                        ->helperText('Explain where this appears or what format the next editor should keep.')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => static::pageOptions()[$state] ?? $state)
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->description(fn (PageBlock $record): string => $record->description ? str($record->description)->limit(90) : $record->key)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('value')
                    ->label('Current content')
                    ->limit(70)
                    ->html()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('key')
                    ->fontFamily('mono')
                    ->copyable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\BadgeColumn::make('type')->colors([
                    'gray' => 'text',
                    'info' => 'rich_text',
                    'warning' => 'json',
                    'success' => 'image',
                    'primary' => 'integer',
                    'danger' => 'boolean',
                ]),

                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->label('Updated')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('page')->options(static::pageOptions()),
                Tables\Filters\SelectFilter::make('type')->options([
                    'text' => 'Text',
                    'rich_text' => 'Rich text',
                    'json' => 'JSON',
                    'image' => 'Image',
                    'boolean' => 'Boolean',
                    'integer' => 'Integer',
                ]),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (PageBlock $record): string => static::previewUrl($record->page))
                    ->openUrlInNewTab(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPageBlocks::route('/'),
        ];
    }

    public static function previewUrl(string $page): string
    {
        return match ($page) {
            'global', 'homepage' => url('/'),
            'voice-otp' => url('/voice-otp'),
            'voice-survey' => url('/voice-survey'),
            'voice-broadcast' => url('/voice-broadcast'),
            'pricing' => url('/pricing'),
            'about' => url('/about'),
            'contact' => url('/contact'),
            'api-docs' => url('/api-docs'),
            'blog' => url('/blog'),
            default => url('/'),
        };
    }
}
