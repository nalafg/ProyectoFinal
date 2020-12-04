<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Loan;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('edit-data')) {
            $loans = Loan::with('user')
                ->with('movie')
                ->orderBy('loan_date', 'desc')
                ->get();
            return view('admin.loans.index',compact('loans'));
        }else{
            $id = Auth::user()->id;
            $loans = Loan::where('user_id', $id)
                ->with('movie')
                ->orderBy('loan_date', 'desc')
                ->get();
            return view('client.loans.index',compact('loans'));
        }
    }

    public function details($id){
        if (Gate::allows('edit-data')) {
            $loan = Loan::where('id',$id)->with('user')->with('movie')->first(); 
            if($loan){
                $movie = Movie::where('id',$loan->movie->id)->with('category')->first();
                $user = User::where('id',$loan->user->id)->first();
                return view('admin.loans.details',compact('loan','movie','user'));
            }else{
                return view('admin.loans.details');
            }
        }else{
            return Redirect::to('movies');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loan = Loan::where('movie_id', $request['movie_id'])
            ->where('user_id',$request['user_id'])
            ->orderBy('loan_date', 'desc')
            ->first();

        if($loan){
            if($loan->status=='PENDIENT')
            return response()->json([
                'message' => 'You have already rented this movie. You cannot rent this movie again until you return it',
                'code' => '220',
            ]);
        }
        $loan = Loan::create([
            'user_id' => $request['user_id'],
            'movie_id' => $request['movie_id'],
            'loan_date' => date("Y-m-d H:i:s"),
        ]);
        $loan->save();
        return response()->json([
            'message' => 'You have rented the movie. You can see it in the loans section',
            'code' => '200',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $loan = Loan::find($request['id']);
        if ($loan->status=='PENDIENT') {
            $loan->status='RETURNED';
            $loan->delivery_date=date("Y-m-d H:i:s");
            $loan->save();
            return response()->json([
                'message' => 'You have returned the movie. You can rent it again in the movie section',
                'code' => '200',
            ]);
        }
        return response()->json([
            'message' => 'An error has ocurred',
            'code' => '220',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $loan = Loan::find($request['id']);

        if ($loan) {
           if ($loan->delete()) {
               return response()->json([
                    'message' => 'The loan has been successfully removed.',
                    'code' => '200',
                ]);
           }
        }
        return response()->json([
            'message' => 'An error has ocurred.',
            'code' => '400',
        ]);
    }
}
