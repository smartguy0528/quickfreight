<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\QuoteDataEquipment;
use App\Models\QuoteDataTrailerSize;
use App\Models\StatusDescription;
use App\Models\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $administrator = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@superdev.com',
                'role' => 0,
                'phone' => '+1 234 567 8901',
                'password' => '$2y$10$GYCwtTFJmUsAK1R7Njw1p.ALaKluQBVoaitYwSzMeTqE2SLZ8Ts7.',
            ]
        ];
        User::insert($administrator);

        $equipment_data = [
            [
                'equipmentId' => '1',
                'equipmentName' => 'Dry Van / Truckload'
            ],
            [
                'equipmentId' => '2',
                'equipmentName' => 'Flatbed / Stepdeck'
            ],
            [
                'equipmentId' => '3',
                'equipmentName' => 'Temperature Controlled - Fresh'
            ],
            [
                'equipmentId' => '4',
                'equipmentName' => 'Temperature Controlled - Frozen'
            ],
            [
                'equipmentId' => '5',
                'equipmentName' => 'Over Dimensional / Other (RGN, DD, Conestoga, Power Only, Tanker, Hopper, Dump)'
            ]
        ];
        QuoteDataEquipment::insert($equipment_data);

        $trailer_size_data = [
            [
                'trailerSizeId' => '1',
                'trailerSizeName' => '48 feet'
            ],
            [
                'trailerSizeId' => '2',
                'trailerSizeName' => '40 feet'
            ],
            [
                'trailerSizeId' => '3',
                'trailerSizeName' => '45 feet'
            ],
            [
                'trailerSizeId' => '4',
                'trailerSizeName' => '53 feet'
            ],
            [
                'trailerSizeId' => '5',
                'trailerSizeName' => 'Other'
            ]
        ];
        QuoteDatatrailerSize::insert($trailer_size_data);

        $status_description = [
            [
                'status_id' => '1',
                'title' => 'Requested',
                'content' => 'Customer requested order. Customer received the confirm email.'
            ],
            [
                'status_id' => '2',
                'title' => 'Checked',
                'content' => 'Company checked the request and sent quote to customer. Company sent email to customer with verify code.'
            ],
            [
                'status_id' => '3',
                'title' => 'Approved',
                'content' => 'Customer approved the quote from the company.'
            ],
            [
                'status_id' => '4',
                'title' => 'Rejected',
                'content' => 'Customer rejected the quote from the company.'
            ],
            [
                'status_id' => '5',
                'title' => 'Confirmed',
                'content' => 'Company and carrier confirmed the quote via RMIS.'
            ],
            [
                'status_id' => '6',
                'title' => 'Submitted',
                'content' => 'Company submitted the quote to carrier.'
            ],
            [
                'status_id' => '7',
                'title' => 'Published',
                'content' => 'Carrier confirmed the quote from company. And sent the sms to driver.'
            ],
            [
                'status_id' => '8',
                'title' => 'To Pickup',
                'content' => 'Driver going to pickup location.'
            ],
            [
                'status_id' => '9',
                'title' => 'Loading',
                'content' => 'Driver loading the staff.'
            ],
            [
                'status_id' => '10',
                'title' => 'On Delivery',
                'content' => 'Driver going to delivery location.'
            ],
            [
                'status_id' => '11',
                'title' => 'Arrived',
                'content' => 'Load arrived to deviery location.'
            ],
            [
                'status_id' => '12',
                'title' => 'Completed',
                'content' => 'Driver sent to photo and complete transport.'
            ],
            [
                'status_id' => '13',
                'title' => 'End',
                'content' => 'Customer make pay and end the request and leave review.'
            ]
        ];
        StatusDescription::insert($status_description);

        $user_roles = [
            [
                'user_role' => '0',
                'content' => 'Super Admin'
            ],
            [
                'user_role' => '1',
                'content' => 'Manager'
            ],
            [
                'user_role' => '2',
                'content' => 'Customer'
            ],
            [
                'user_role' => '3',
                'content' => 'Carrier'
            ],
            [
                'user_role' => '4',
                'content' => 'Driver'
            ]
        ];
        UserRole::insert($user_roles);
    }
}
