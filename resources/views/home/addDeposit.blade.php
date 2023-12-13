@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            @include('partials.slidebar');
        </div>
        <div class="col-8">
            <h1>Add Deposit</h1>
            <form action="{{ route('home.addDeposit')}}" method="post">
                @csrf
                <input type="number" placeholder="Add Deposit" class="form form-control" name="deposit" id=""><br>
                @error('deposit')
                    <p class="bg-warning">{{$errors->first('deposit')}}</p>
                @enderror
                <button type="submit" class="btn btn-info form-control">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
