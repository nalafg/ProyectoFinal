<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loan = new Loan();
        $loan->user_id = 2;
        $loan->movie_id = 1;
        $loan->loan_date = '2020-11-05 12:00:00';
        $loan->save();
    }
}
