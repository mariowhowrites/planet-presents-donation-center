<?php

namespace App\Filament\Resources\WishlistResource\Widgets;

use App\Models\Pledge;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PledgesByWishlist extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pledge::where('wishlist_id', auth()->user()->currentWishlist()->id)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('amount')
                    ->formatStateUsing(fn (string $state): string => "$$state")
                    ->color('success')
                    ->summarize([
                        Sum::make()->label('Total Pledged')->formatStateUsing(fn (string $state): string => "$$state"),
                    ]),
                Tables\Columns\TextColumn::make('message')->wrap(),
                Tables\Columns\TextColumn::make('created_at'),
            ]);
    }
}
