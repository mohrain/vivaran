<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Office;
use App\Models\OfficeCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $address = Address::create([
                'province' => 'सुदूरपश्चिम प्रदेश',
                'district' => 'कैलाली',
                'municipality' => 'डेमो नगरपालिका',
                'type' => 'नगरपालिका',
                'total_ward_number' => 7,
        ]);

        $office_type = OfficeCategory::create([
             'office_type'=>'सरकारी',
        ]);

        $office = Office::create([
            'office_name' => 'डेमो कार्यालय',
            'office_email' => 'डेमो इमेल @gmail.com',
            'office_phone' => '9800000000',
            'office_address' => '',
            'office_code' => '',
            'address_id' => $address->id,
            'office_category_id'=>$office_type->id,          
        ]);

        $user=User::create([
            'name' => 'Editor',
            'email' => 'demo.editor@gmail.com',
            'password' => '$2y$12$cH3UK/yMotIT0kcFec4NnOImAlinQVO1yrNBqchugxfDp75rQK68O',
            'office_id'=>$office->id,
        ]);

         $user = User::create([
            'name' => 'Admin',
            'email' => 'demo.admin@gmail.com',
            'password' => '$2y$12$cH3UK/yMotIT0kcFec4NnOImAlinQVO1yrNBqchugxfDp75rQK68O',
            'office_id'=>$office->id,
        ]);
    }
}
