<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Movie;
use App\Models\Loan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::with('category')->get(); 
        $categories = Category::all();
        if (Gate::allows('edit-data')) {
            return view('admin.movies.index',compact('movies','categories'));
        }else{
            return view('client.movies.index',compact('movies','categories',));
        }
    }

    public function details($id){
        if (Gate::allows('edit-data')) {
            $movie = Movie::where('id',$id)->first();
            $loans = Loan::where('movie_id',$id)->with('user')->get();
            $categories = Category::all();
            return view('admin.movies.details',compact('movie','loans','categories'));
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
        if($movie = Movie::create($request->all())){
            if($request->hasFile('cover_file')){
                $file = $request->file('cover_file');
                $file_name = 'cover_movie'.$movie->id.".".$file->getClientOriginalExtension();

                $path = $request->file('cover_file')->storeAs(
                    'img',$file_name
                );
                $movie->cover = $file_name;
                $movie->save();
            }
            return redirect()->back();
        }
       return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
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
        $movie = Movie::find($request['id']);
        if($request->hasFile('cover_file')){
            $file = $request->file('cover_file');
            $file_name = "cover_movie_".$movie->id.".".$file->getClientOriginalExtension();
            $path = $request->file('cover_file')->storeAs(
                'img',$file_name
            );
            $request->cover = $file_name;
        }else{
            $request->cover = $movie->cover;
        }
        
        if ($movie) {
            if ($movie->update($request->all())) {
                $movie->cover = $request->cover;
                $movie->save();
                return redirect()->back();
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $movie = Movie::find($request['id']);

        if ($movie) {
           if ($movie->delete()) {
               return response()->json([
                    'message' => 'The movie has been successfully removed.',
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
