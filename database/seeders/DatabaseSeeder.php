<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Charity;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'mario',
            'email' => 'mariovegadev@gmail.com',
            'password' => env('ADMIN_PASSWORD', 'password'),
            'role' => 'admin',
        ]);

        Charity::insert([
            [
                'name' => 'North East Trees',
                'description' => 'North East Trees is a Los Angeles-area nonprofit dedicated to providing more greenspace for the community, as well as encouraging environmental stewardship in the workforce and education. Thanks to generous donations from people like you, North East Trees has been able to improve the quality of life for thousands of Angelenos, planting over 100,000 trees.',
                'preview_image' => 'https://planetpresentsdonationcenter.org/wp-content/uploads/2023/08/IMG_1320-1.jpg',
                'donation_url' => 'https://www.northeasttrees.org/support-us',
                'charity_url' => 'https://www.northeasttrees.org',
            ],
            [
                'name' => 'Coral Gardeners',
                'description' => 'Coral Gardeners is a truly unique nonprofit based in French Polynesia, with the goal of saving and restoring coral reefs across the world and educating the public about these amazing ecosystems. Coral Gardeners has had massive success, from planting over 30,000 corals to reaching millions of people, thanks to contributions from people like you.',
                'preview_image' => 'https://planetpresentsdonationcenter.org/wp-content/uploads/2023/08/d2ef715226e33451b9218a7b50aa26ff-1-e1691098695659.jpg',
                'donation_url' => 'https://coralgardeners.org/pages/donation',
                'charity_url' => 'https://coralgardeners.org',
            ],
            [
                'name' => 'Marine Mammal Care Center',
                'description' => 'The Marine Mammal Care Center is a marine mammal hospital responding to sick sea life throughout Los Angeles County’s coast. MMCC is a leader in marine mammal rehabilitation, research, and education, responding to thousands of patients in its lifetime and teaching over 10,000 students every year.',
                'preview_image' => 'https://planetpresentsdonationcenter.org/wp-content/uploads/2023/08/Volunteer-1024x678-1-e1691263629614.jpg',
                'donation_url' => 'https://host.nxt.blackbaud.com/donor-form/?svcid=renxt&formId=2eaec1a0-6607-4af8-8e1f-f337aebe8c31&envid=p-UtGXOZMbGkioqtPMFnxKRA&zone=usa',
                'charity_url' => 'https://coralgardeners.org',
            ],
            [
                'name' => 'Friends of the LA River',
                'description' => 'Friends of the LA River (FoLAR) has been a leader in Los Angeles-area environmental advocacy and education for over 30 years. And as the name suggests, it all started with the Los Angeles River, a waterway once desolate that FoLAR works to transform into a vibrant, functioning ecosystem, supporting the residents of LA as well. FoLAR has some truly incredible and unique projects, from their mobile education station “LA River Rover” to their annual LA River Cleanup, but none of it would be possible without donations from caring individuals like yourself.',
                'preview_image' => 'https://planetpresentsdonationcenter.org/wp-content/uploads/2023/08/community-events_01.jpg',
                'donation_url' => 'https://folar.org/donate-now/',
                'charity_url' => 'https://folar.org',
            ]
        ]);

        // for each charity, we want to create 4 tiers: one at $10, one at $20, one at $50, and one at $100

        for ($i = 1; $i <= 4; $i++) {
            Tier::insert([
                [
                    'name' => 'Tier 1',
                    'description' => 'This is the first tier of donations. It is $10.',
                    'amount' => 10,
                    'charity_id' => $i,
                ],
                [
                    'name' => 'Tier 2',
                    'description' => 'This is the second tier of donations. It is $20.',
                    'amount' => 20,
                    'charity_id' => $i,
                ],
                [
                    'name' => 'Tier 3',
                    'description' => 'This is the third tier of donations. It is $50.',
                    'amount' => 50,
                    'charity_id' => $i,
                ],
                [
                    'name' => 'Tier 4',
                    'description' => 'This is the fourth tier of donations. It is $100.',
                    'amount' => 100,
                    'charity_id' => $i,
                ]
            ]);
        }
    }
}
