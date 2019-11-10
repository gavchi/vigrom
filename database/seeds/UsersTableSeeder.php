<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Wallet;
use App\Models\Transaction;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 2)->create()->each(function ($u) {
            /** @var User $u */
            $u->wallet()->save(factory(Wallet::class)->make());
            $u->wallet->transactions()->saveMany(factory(Transaction::class, 10)->make());
            $u->wallet->balance = $u->wallet->getRealBalance();
            $u->wallet->save();
        });
    }
}
