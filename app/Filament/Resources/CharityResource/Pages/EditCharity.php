<?php

namespace App\Filament\Resources\CharityResource\Pages;

use App\Filament\Resources\CharityResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditCharity extends EditRecord
{
    protected static string $resource = CharityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_charity')
                ->label('View Charity')
                ->url(route('charity.show', ['id' => $this->record->id])),
            Actions\DeleteAction::make(),
        ];
    }
}
