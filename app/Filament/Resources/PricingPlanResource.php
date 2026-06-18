<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricingPlanResource\Pages;
use App\Models\PricingPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PricingPlanResource extends Resource
{
    protected static ?string $model = PricingPlan::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-bangladeshi';
    protected static ?string $navigationGroup = 'Marketing site';
    protected static ?int    $navigationSort = 20;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Plan')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                    Forms\Components\Textarea::make('description')->rows(2)->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Pricing')
                ->columns(3)
                ->schema([
                    Forms\Components\TextInput::make('price_monthly')->numeric()->prefix('৳')
                        ->helperText('Leave blank for custom.'),
                    Forms\Components\TextInput::make('price_yearly')->numeric()->prefix('৳')
                        ->helperText('Per month, billed yearly.'),
                    Forms\Components\TextInput::make('rate_per_min')
                        ->helperText('e.g. 0.45 or "Custom".'),
                    Forms\Components\TextInput::make('rate_note')
                        ->columnSpanFull()
                        ->helperText('Line shown under the price, e.g. "+ ৳0.45 per minute · Volume discounts apply".'),
                ]),

            Forms\Components\Section::make('Features & call to action')
                ->columns(2)
                ->schema([
                    Forms\Components\Repeater::make('features')
                        ->simple(Forms\Components\TextInput::make('feature')->required())
                        ->columnSpanFull()
                        ->addActionLabel('Add feature'),
                    Forms\Components\TextInput::make('cta_label')->default('Get Started'),
                    Forms\Components\TextInput::make('cta_url')->url(),
                    Forms\Components\TextInput::make('badge')->helperText('e.g. "Most Popular" — leave blank for none.'),
                ]),

            Forms\Components\Section::make('Display')
                ->columns(3)
                ->schema([
                    Forms\Components\Toggle::make('is_featured')->label('Highlight as featured'),
                    Forms\Components\Toggle::make('is_active')->default(true),
                    Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
            Tables\Columns\TextColumn::make('name')->weight('bold')->searchable(),
            Tables\Columns\TextColumn::make('price_monthly')->money('BDT', divideBy: 1)->label('Monthly'),
            Tables\Columns\TextColumn::make('rate_per_min')->label('Rate/min')->prefix('৳'),
            Tables\Columns\TextColumn::make('badge')->badge()->color('warning'),
            Tables\Columns\IconColumn::make('is_featured')->boolean()->label('★'),
            Tables\Columns\IconColumn::make('is_active')->boolean(),
        ])
        ->reorderable('sort_order')
        ->defaultSort('sort_order')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPricingPlans::route('/'),
            'create' => Pages\CreatePricingPlan::route('/create'),
            'edit'   => Pages\EditPricingPlan::route('/{record}/edit'),
        ];
    }
}
