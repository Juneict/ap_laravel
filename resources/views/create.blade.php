@extends('layout')
@section('content')
    <div class="container">
       
        <div class="card">
            <div class="card-header" style="text-align:center">
                New Post
            </div>
            <div class="card-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                         <ul>
                             @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif
            
                    <form action="/posts" method="post">
                        @csrf
                        <div class="from-group">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" >
                        </div>
                        <div class="from-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter Name">{{ old('description')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value=""> Select Category</option>
                                @foreach($categories as $cat)
                                     <option value="{{ $cat->id }}"> {{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                       
                            <a href="/posts" class="btn btn-success">Back</a>
                        
                    </form>
                
               
            </div>
        </div>
    </div>
   
@endsection 