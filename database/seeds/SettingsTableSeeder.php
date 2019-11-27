<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * The settings to add.
     */
    protected $settings = [
        [
            'key'         => 'home_banner_text',
            'name'        => 'Text for Home banner',
            'description' => 'Text for banner at Home page',
            'value'       => 'Travel experiences made for you',
            'field'       => '{"name":"value","label":"Value","type":"text"}',
            'active'      => 1,
        ],
        [
            'key'           => 'home_banner_image',
            'name'          => 'Image for home banner',
            'description'   => 'main image',
            'value'         => '/images/bg-images/Ha%20long%20bay_1350x450.jpg',
            'field'         => '{"name":"value","label":"Value","type":"image"}',
            'active'        => 1,

        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = DB::table('settings')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted '.count($this->settings).' records.');
    }
}
