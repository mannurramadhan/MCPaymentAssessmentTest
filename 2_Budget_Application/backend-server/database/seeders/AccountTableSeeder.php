<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Only for filling the account table when it's empty or after migrate
        $user = User::all();
        $account_type = ['Wallet', 'Bank Account'];

        foreach ($user as $u) {
            for ($i = 0; $i < count($account_type); $i++) {
                Account::create([
                    'user_id' => $u->id,
                    'account_type' => $account_type[$i],
                    'account_balance' => 0,
                ]);
            }
        }
    }
}
