<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                'name' => 'Baju'
            ]
            );

        DB::table('categories')->insert(
            [
                'name' => 'Celana'
            ]
            );

        DB::table('categories')->insert(
            [
                'name' => 'Kaos'
            ]
            );

        DB::table('categories')->insert(
            [
                'name' => 'Jilbab'
            ]
            );

        DB::table('categories')->insert(
            [
                'name' => 'Hoodie'
            ]
            );

        DB::table('categories')->insert(
            [
                'name' => 'Jas'
            ]
            );

        DB::table('categories')->insert(
            [
                'name' => 'Celana Dalam'
            ]
            );


    }
}
