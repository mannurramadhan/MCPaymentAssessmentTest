<?php

namespace Database\Seeders;

use App\Models\TransactionCategory;
use Illuminate\Database\Seeder;

class TransactionCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = array('Home', 'Phone', 'Food', 'Health', 'Clothing', 'Gift');
        for ($i = 0; $i < count($name); $i++) {
            TransactionCategory::create([
                'name' => $name[$i],
                'icon_url' => "icons/transaction_category/" . strtolower($name[$i]) . ".svg"
            ]);
        }
    }
}
