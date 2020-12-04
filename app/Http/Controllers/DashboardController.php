<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Loan;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Gate::allows('edit-data')) {
            $date = \Carbon\Carbon::today()->subDays(7);
            $loans = Loan::with('user')
                ->groupBy('user_id')
                ->where('created_at','>=',$date)
                ->select('user_id', DB::raw('count(*) as total'))
                ->get();

            $movie = Loan::with('movie')
                ->groupBy('movie_id')
                ->where('created_at','>=',$date)
                ->select('movie_id', DB::raw('count(*) as total'))
                ->get();

            $dataU[] = ['Name', 'Qnt Rented'];
            $dataM[] = ['Movie','Times Rented'];
            foreach($loans as $key => $value){
                $dataU[++$key] = [$value->user->name, $value->total];
            }
            foreach($movie as $key => $value){
                $dataM[++$key] = [$value->movie->title, $value->total];
            }
            return view('dashboard')
                ->with('users_data', json_encode($dataU))
                ->with('movie_data', json_encode($dataM));
        }else{
            return Redirect::to('movies');
        }
    }
}
