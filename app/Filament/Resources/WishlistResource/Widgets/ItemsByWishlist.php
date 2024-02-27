<?php

namespace App\Filament\Resources\WishlistResource\Widgets;

use App\Models\WishlistItem;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ItemsByWishlist extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                WishlistItem::where('wishlist_id', auth()->user()->currentWishlist()->id)
            )
            ->columns([
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('tier.name'),
                Tables\Columns\TextColumn::make('tier.charity.name'),
            ])
            ->actions([
                DeleteAction::make(),
            ]);
    }
}
