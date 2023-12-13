@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            @include('partials.slidebar');
        </div>
        <div class="col-8">
            <h1>New Ad</h1>
            <form action="{{ route('home.showForm') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" id="" placeholder="title" class="form-control m-2">
                <textarea name="body" class="form-control m-2" name="body" id="" cols="30" placeholder="body" rows="10"></textarea>
                <input type="number" name="price" class="form-control m-2" placeholder="Price" id="">
                <input type="file" name="image1" class="form-control m-2">
                <input type="file" name="image2" class="form-control m-2">
                <input type="file" name="image3" class="form-control m-2">
                <select class="form-control m-2" name="category" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-danger m-2">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
