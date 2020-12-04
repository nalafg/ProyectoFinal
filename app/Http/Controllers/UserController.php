<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('edit-data')) {
            $users = User::where('rol','CLIENT')->get(); 
            return view('admin.users.index',compact('users'));
        }else{
            return Redirect::to('movies');
        }
    }

    public function details($id){
        if (Gate::allows('edit-data')) {
            $user = User::where('id',$id)->first(); 
            $loans = Loan::where('user_id', $id)
                ->with('movie')
                ->orderBy('loan_date', 'desc')
                ->get();
            return view('admin.users.details',compact('user','loans'));
        }else{
            return Redirect::to('movies');
        }
    }
}
