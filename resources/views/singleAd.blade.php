@extends('layouts.master')


@section('main')
    <div class="row">
        @if (isset($ad->image1))
            <div class="col-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <img id="main-image" src="\ad_image\{{$ad->image1}}" class="img-fluid">    
                    </div>
                </div>
            </div>                    
        @endif
        @if (isset($ad->image2))
            <div class="col-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <img id="main-image" src="\ad_image\{{$ad->image2}}" class="img-fluid">    
                    </div>
                </div>
            </div>                    
        @endif
        @if (isset($ad->image3))
            <div class="col-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <img src="\ad_image\{{$ad->image3}}" class="img-fluid">    
                    </div>
                </div>
            </div>                    
        @endif
    </div>


    <div class="col-12">
        <h1 class="display-4">{{$ad->title}} <span class="btn btn-success">{{$ad->category->name}}</span> </h1>
        <p>{{$ad->body}}</p>

        <button class="btn btn-warning">{{$ad->user->name }}</button>
        <button class="btn btn-danger">{{$ad->price}}</button>

        @if (auth()->check() && auth()->user()->id !== $ad->user_id)
        <div class="row mt-3">
            <div class="col-6">
                <form action="{{ route('sendMessage', ['id'=>$ad->id]) }}" method="POST">
                    @csrf
                    <textarea name="msg" id="" cols="30" rows="10" class="form-control" placeholder="Send message to {{$ad->user->name}}"></textarea> <br>
                    <button type="submit" class="btn btn-primary form-control">Send</button>
                </form>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{session()->get('message')}}
                    </div>
                @endif
            </div>

        </div>
        @endif

        
    </div>

    
@endsection