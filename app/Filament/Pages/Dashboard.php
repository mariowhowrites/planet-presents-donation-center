<?php

namespace App\Filament\Pages;

use App\Enums\WishlistStatus;
use App\Filament\Resources\WishlistResource\Widgets\ItemsByWishlist;
use App\Filament\Resources\WishlistResource\Widgets\PledgesByWishlist;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard as FilamentDashboard;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class Dashboard extends FilamentDashboard implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.manage-wishlist';

    protected static ?string $title = 'Manage Wishlist';

    public $wishlist = null;

    public function mount()
    {
        $this->wishlist = auth()->user()->currentWishlist();
        $this->form->fill($this->wishlist->toArray());
    }

    #[On('wishlist-status-updated-{wishlist.id}')]
    public function updateWishlist($status)
    {
        Log::info($status);

        $this->wishlist->refresh();
        $this->form->fill($this->wishlist->toArray());

        Notification::make()
            ->success()
            ->title($status === WishlistStatus::Public->value ? 'Wishlist published' : 'Wishlist unpublished')
            ->send();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
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

            $this->wishlist->update($data);
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
        $header_actions = [
            Action::make('view_wishlist')
                ->label('View Wishlist')
                ->url(route('my-wishlist'))
        ];

        $header_actions[] = $this->wishlist->isPublic() ?
            Action::make('unpublish_wishlist')
            ->label('Unpublish Wishlist')
            ->requiresConfirmation()
            ->action(function () {
                $this->wishlist->unpublish();

                $this->dispatch('wishlist-status-updated-' . $this->wishlist->id, WishlistStatus::Private);
            }) :
            Action::make('publish_wishlist')
            ->label('Publish Wishlist')
            ->requiresConfirmation()
            ->action(function () {
                $this->wishlist->publish();

                $this->dispatch('wishlist-status-updated-' . $this->wishlist->id, WishlistStatus::Public);
            });

        return $header_actions;
    }

    public function getHeaderWidgets(): array
    {
        return [
            PledgesByWishlist::class,
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
