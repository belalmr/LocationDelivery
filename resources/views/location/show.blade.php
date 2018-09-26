@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Details</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class=" form-group" style="margin: 10px">
                        <label for="country" class=" col-form-label"><b>title</b>: {{$location->title }}</label> &nbsp;<br>
                        <label for="country" class=" col-form-label"><b>distance:</b> {{$location->distance}} km</label><br> &nbsp;
                        <label for="country" class=" col-form-label"><b>price:</b> {{$location->distance_price }} $</label> &nbsp;<br>
                        
                    </div>
                <a href="{{ route('location.index') }}"
                    class="btn btn-primary btn-rounded btn-sm my-0">
                     return
                 </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
