<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int    $navigationSort = 10;
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Article')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(180)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $state, callable $set) =>
                            $set('slug', Str::slug($state))
                        )
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(220)
                        ->columnSpanFull(),

                    Forms\Components\Textarea::make('excerpt')
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('1–2 sentence summary shown in card listings.')
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('body')
                        ->required()
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('blog-attachments'),
                ]),

            Forms\Components\Section::make('Taxonomy')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->options(BlogCategory::active()->pluck('name', 'id') ?? [])
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('color')->default('#0070BA'),
                        ]),

                    Forms\Components\Select::make('tags')
                        ->relationship('tags', 'name')
                        ->multiple()
                        ->preload()
                        ->searchable()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->required(),
                        ]),
                ]),

            Forms\Components\Section::make('Hero & media')
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('featured_image_url')
                        ->image()
                        ->directory('blog-featured')
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->columnSpanFull(),

                    Forms\Components\Select::make('hero_gradient')
                        ->options([
                            'navy-blue'   => 'Navy → Blue',
                            'blue-sky'    => 'Blue → Sky',
                            'gold-orange' => 'Gold → Orange',
                            'navy-blue-sky' => 'Navy → Blue → Sky',
                        ])
                        ->default('navy-blue'),

                    Forms\Components\TextInput::make('reading_minutes')
                        ->numeric()
                        ->suffix('min')
                        ->placeholder('auto-calculated if blank'),
                ]),

            Forms\Components\Section::make('Publishing')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'draft'     => 'Draft',
                            'scheduled' => 'Scheduled',
                            'published' => 'Published',
                            'archived'  => 'Archived',
                        ])
                        ->default('draft')
                        ->required()
                        ->live(),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Publish at')
                        ->default(now())
                        ->required(fn (callable $get) => in_array($get('status'), ['published', 'scheduled'])),

                    Forms\Components\Toggle::make('is_featured')
                        ->label('Feature on blog homepage')
                        ->columnSpanFull(),

                    Forms\Components\Select::make('author_id')
                        ->label('Author')
                        ->relationship('author', 'name')
                        ->default(auth()->id())
                        ->required()
                        ->searchable()
                        ->preload(),
                ]),

            Forms\Components\Section::make('SEO')
                ->collapsed()
                ->schema([
                    Forms\Components\KeyValue::make('seo')
                        ->keyLabel('Field')
                        ->valueLabel('Value')
                        ->default([
                            'title'       => '',
                            'description' => '',
                            'og_image'    => '',
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image_url')
                    ->label('Cover')
                    ->circular()
                    ->size(38),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(60)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray'    => 'draft',
                        'warning' => 'scheduled',
                        'success' => 'published',
                        'danger'  => 'archived',
                    ])
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('★'),

                Tables\Columns\TextColumn::make('view_count')
                    ->label('Views')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'draft' => 'Draft', 'scheduled' => 'Scheduled',
                    'published' => 'Published', 'archived' => 'Archived',
                ]),
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit'   => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) BlogPost::where('status', 'draft')->count();
    }
}
