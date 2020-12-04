<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col m-2">
			<button class="btn btn-primary float-right" data-toggle="modal" data-target="#addMovie">
				Add Movie
			</button>
		</div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
				<table class="table table-striped table-bordered">
				  <thead class="thead-dark ">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Title</th>
				      <th scope="col">Classification</th>
					  <th scope="col">Category</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if (isset($movies) && count($movies)>0)
				  	@foreach ($movies as $movie)
				  	<tr>
				      <th scope="row">
				      	{{ $movie->id }}
				      </th>
				      <td> {{ $movie->title }} </td>
				      <td> {{ $movie->classification }} </td>
					  <td> {{ $movie->category->name }} </td>
					  <td><a href="{{ url('/movies/'.$movie->id) }}">See Details</a> </td>
				    </tr> 
				  	@endforeach
				  	@endif 
				  </tbody>
				</table>
            </div>
        </div>
    </div>

	<div class="modal fade" id="addMovie" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Add New Movie</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <form method="post" action="{{ url('movies') }}" enctype="multipart/form-data">
	      	@csrf 

	      	<div class="modal-body">
		        
	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Title
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="Title example" aria-label="Title example" aria-describedby="basic-addon1" name="title" required="">
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Description
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <textarea class="form-control" rows="5" placeholder="description of de category" name="description"></textarea>
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Classification
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
						<select class="form-control" name="classification">
							<option>AA</option>
							<option>A</option>
							<option>B</option>
							<option>B15</option>
							<option>C</option>
							<option>D</option>
						</select>
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Minutes
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="number" class="form-control" placeholder="132" name="minutes" required="">
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Year
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="number" class="form-control" placeholder="2000" name="year" required="">
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Cover
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="file" class="form-control" name="cover_file" required="">
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Trailer
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="youtube.com/" name="trailer" required="">
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Categories
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
						<select class="form-control" name="category_id">
							@if (isset($categories) && count($categories)>0)
								@foreach($categories as $category)
								<option value="{{$category -> id}}">
									{{$category -> name}}
								</option>
								@endforeach
							@endif
						</select>
					</div>
				 </div>


		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">
		        	Cancel
		        </button>
		        <button type="submit" class="btn btn-primary">
		        	Save data
		        </button>
		      </div>

	      </form>

	    </div>
	  </div>
	</div> 

</x-app-layout> 