<?php

namespace App\Filament\Pages;

use App\Filament\Resources\WishlistResource\Widgets\ItemsByWishlist;
use App\Filament\Resources\WishlistResource\Widgets\PledgesByWishlist;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class MyWishlist extends Page implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-wishlist';

    public function mount()
    {
        $this->form->fill(auth()->user()->currentWishlist()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')
                    ->required()
            ])
            ->statePath('data');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save')
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            auth()->user()->currentWishlist()->update($data);
        } catch (Halt $e) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('view_wishlist')
                ->label('View Wishlist')
                ->url(route('my-wishlist'))
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            PledgesByWishlist::class
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            ItemsByWishlist::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|string|array
    {
        return 1;
    }
    
    public function getFooterWidgetsColumns(): int|string|array
    {
        return 1;
    }

    public function wishlistInfolist(Infolist $infolist)
    {
        return $infolist
            ->record(auth()->user()->currentWishlist())
            ->schema([
                TextEntry::make('description')
                    ->label('Description')
            ]);
    }
}
