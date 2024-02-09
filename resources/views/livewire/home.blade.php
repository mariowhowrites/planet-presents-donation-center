<section id="home-main-content" class="flex items-center justify-center gap-4 py-24 sm:py-32">
    <div class="w-3/5 flex flex-col items-center gap-8 mx-auto">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Planet Presents Donation Center</h1>
        <p class="">
            This page is your home for finding unique and hard-working environmental nonprofits that will use your
            donations
            to change the world for the better. Whether it be LA river revitalization or marine mammal rescue, these
            nonprofits will use every penny to make the world a better place!
        </p>
        <section class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-2">
            @foreach ($charities as $charity)
                <div class="flex items-center justify-center h-64 w-64 bg-cover" style="background-image: url('{{ $charity->preview_image }}')">
                    <a class="text-white font-bold" href="{{ route('charity.show', $charity->id) }}" wire:navigate>{{ $charity->name }}</a>
                </div>
            @endforeach
        </section>
    </div>
</section>
