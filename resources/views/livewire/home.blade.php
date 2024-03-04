<section id="home-main-content" class="flex items-center justify-center gap-4 py-24 sm:py-32">
    <div class="w-4/5 md:w-3/5 flex flex-col items-center gap-8 mx-auto">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Planet Presents Donation Center</h1>
        <p class="font-serif">
            This page is your home for finding unique and hard-working environmental nonprofits that will use your
            donations
            to change the world for the better. Whether it be LA river revitalization or marine mammal rescue, these
            nonprofits will use every penny to make the world a better place!
        </p>
        <div class="mx-auto max-w-7xl lg:px-8">
            <ul role="list"
                class="mx-auto first:mt-0 mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                @foreach ($charities as $charity)
                    <li>
                        <a href="{{ route('charity.show', $charity->id) }}" wire:navigate>
                            <img class="aspect-[3/2] w-full rounded-2xl object-cover"
                                src="{{ asset($charity->preview_image) }}" alt="">
                            <h3 class="mt-6 text-lg font-semibold leading-8 tracking-tight text-gray-900">
                                {{ $charity->name }}</h3>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
