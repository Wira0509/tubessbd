<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItineraryResource\Pages;
use App\Filament\Resources\ItineraryResource\RelationManagers;
use App\Models\Itinerary;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Label;  

class ItineraryResource extends Resource
{
    protected static ?string $model = Itinerary::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('author_id')
                    ->relationship('author', 'name')
                    ->required(),

                Forms\Components\MultiSelect::make('itinerary_category_id')
                    ->relationship('ItineraryCategory', 'title')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),

                Forms\Components\TextInput::make('slug')
                    ->readOnly(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->columnSpanFull()
                    ->required(),

                Forms\Components\RichEditor::make('content')
                    ->columnSpanFull()  
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\TextColumn::make('ItineraryCategory.title')
                    ->badge()
                    ->separator(', ')
                    ->sortable()
                    ->label('Categories'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\ToggleColumn::make('is_featured')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('author_id')
                    ->label('Select Author')
                    ->relationship('author', 'name'),
                Tables\Filters\SelectFilter::make('itinerary_category_id')
                    ->label('Select Category')
                    ->relationship('ItineraryCategory', 'title')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItineraries::route('/'),
            'create' => Pages\CreateItinerary::route('/create'),
            'edit' => Pages\EditItinerary::route('/{record}/edit'),
        ];
    }
}
