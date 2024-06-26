@script
    <script>
        $wire.on('pledge-created', () => {
            window.open("{{ $charity->donation_url }}", "_blank")
        });
    </script>
@endscript

<section id="thank-you-main-content" class="flex flex-col items-center justify-center gap-8 py-24 sm:py-32">
    <h1 id="thank-you-header" class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Thank you!!!</h1>
    <p>Thanks so much for your pledge! Contributions like yours go a long way towards making our planet a better place
        to live.</p>

    <p>The donation page for {{ $charity->name }} should have opened in a new tab.</p>

    <p>If not, please follow this link to continue to the charity's donation page: <a class="text-blue-500 underline"
            href="{{ $charity->donation_url }}">{{ $charity->name }} Donation Page</a>.

    <p>The wishlist owner has been notified about your donation.</p>

    <a href="{{ route('home') }}" class="text-blue-500 underline">Back to home</a>
</section>
