<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row">
          
      @if (isset($movie))
      <div class="col-12">
        <a href="{{ url('movies') }}">Go Back to Movies</a>
      </div>
      
            <div class="col-12 col-md-4 p-2">
                <div class="card text-right">
                  <form method="post" action="{{ url('movies') }}" enctype="multipart/form-data">
                    @csrf  
                    @method('PUT')

                    <img class="cover-img" src="{{ asset('img/'.$movie->cover) }}">
                    <div class="card-body">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-white" id="inputGroup-sizing-default">Title</span>
                        </div>
                        <input type="text" class="form-control bg-white" value="{{ $movie->title }}" name="title" disabled>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-white" id="inputGroup-sizing-default">Desc.</span>
                        </div>
                        <textarea rows="5" class="form-control bg-white" name="description" disabled>{{ $movie->description }}</textarea>
                      </div>

                      <div class="form-group">
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-white" id="basic-addon1">Clasification</span>
                        </div>
                        <input type="text"class="form-control bg-white clas" value="{{ $movie->classification }}" disabled>
                        <select class="form-control clas-show" name="classification" id="classification" hidden>
                          <option>AA</option>
                          <option>A</option>
                          <option>B</option>
                          <option>B15</option>
                          <option>C</option>
                          <option>D</option>
                        </select>
                      </div>
                     </div>

                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-white" id="inputGroup-sizing-default">Minutes</span>
                      </div>
                      <input type="number" class="form-control bg-white" value="{{ $movie->minutes }}" name="minutes" disabled>
                      </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-white" id="inputGroup-sizing-default">Year</span>
                      </div>
                      <input type="number" class="form-control bg-white" value="{{ $movie->year }}" name="year" disabled>
                    </div>

                    <div class="form-group clas-show" hidden>
                      <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-white" id="basic-addon1">Cover</span>
                      </div>
                      <input type="file" class="form-control overflow-hidden" name="cover_file">
                    </div>
                   </div>

                   <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-white" id="inputGroup-sizing-default">Trailer</span>
                    </div>
                    <input type="text" class="form-control bg-white" value="{{ $movie->trailer }}" name="trailer" id="trailer" disabled>
                  </div>

                  <div class="form-group">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-white" id="basic-addon1">Category</span>
                    </div>
                    <input type="text" class="form-control bg-white clas" value="{{ $movie->category->name }}" disabled>
                    <select class="form-control clas-show" name="category_id" id="categorie" hidden>
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

                  <div class="d-flex">
                    <input type="hidden" name="id" id="id" value="{{$movie->id}}">
                    <input type="submit" class="btn btn-success flex-fill m-2 clas-show" value="Sent" hidden>
                    <input type="button" class="btn btn-danger flex-fill m-2 clas-show" value="Cancel" onclick="cancelEdit()" hidden>
                  </div>

                      <div class="d-flex justify-content-between">
                        <a onclick="edit('{{$movie->category->id}}','{{ $movie->classification }}')" class="btn btn-primary flex-fill m-2 clas">Edit</a>
                        <a onclick="remove({{ $movie->id }},this)" class="btn btn-danger flex-fill m-2 clas">Delete</a>
                      </div>
                    </div>
                  </form>
                </div>
            </div>

            <div class="col-12 col-md-8 p-2">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="table table-striped table-bordered">
                      
                      <tbody>
                        @if (isset($loans) && count($loans)>0)
                          <thead class="thead-dark ">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">User</th>
                              <th scope="col">Loan Date</th>
                              <th scope="col">Delivery Date</th>
                            </tr>
                          </thead>
                          @foreach ($loans as $loan)
                            <tr>
                                <th scope="row">
                                    {{ $loan->id }}
                                </th>
                                <td> {{ $loan->user->name }} </td>
                                <td> {{ date('j F, Y, H:i', strtotime($loan->loan_date)) }} </td>
                                <td>
                                    @if($loan->status=='PENDIENT')
                                        {{ $loan->status }}
                                    @else
                                      {{ date('j F, Y, H:i', strtotime($loan->delivery_date)) }}
                                    @endif
                                </td>
                            </tr> 
                          @endforeach
                        @else
                            <p class="text-center text-muted p-2">This Movie Doesn't Have A Rental History Yet.</p>
                        @endif 
                      </tbody>
                    </table>
                </div>
            </div>

      @else
      <div>
        <h3 class="text-muted p-2">Ups. This Movie Doesn't Exist.</h3>
        <p><a href="{{ url('movies') }}">Go Back.</a></p>
      </div>
			@endif 
        </div>
	</div>
	
	<style>
		.cover-img{
			height: 18rem;
			object-fit: cover;
		}
	</style>

<x-slot name="scripts">
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">

     	function edit(categorie, classification){
         $('.clas').prop('hidden',true);
         $('.clas-show').prop('hidden',false);
         $('input,textarea').prop('disabled',false);
         document.getElementById('categorie').value = categorie
         document.getElementById('classification').value = classification
      }
      
      function cancelEdit(){
         $('.clas').prop('hidden',false);
         $('.clas-show').prop('hidden',true);
         $('input,textarea').prop('disabled',true);
     	}

     	function remove(id,target){
     		swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this movie!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			}).then((willDelete) => {
			  if (willDelete) {
			  	axios({
            method: 'delete',
            url: '{{ url('movies') }}',
            data: {
              id: id,
              _token: '{{ csrf_token() }}'
            }
				  }).then(function (response) { 
				    if(response.data.code==200){
				    	swal(response.data.message, {
					      icon: "success",
					    }).then(() => { 
                window.location.href = ('/movies/')
              });
				    }else{
				    	swal(response.data.message, {
					      icon: "error",
					    });
				    }
				  });
			  } else {
			    swal("Your record is safe!");
			  }
			});
     	}
     </script>
    </x-slot>

</x-app-layout> 