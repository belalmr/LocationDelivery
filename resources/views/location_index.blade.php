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
                    <table class="table table-striped table-responsive-md btn-table">
                        <thead>
                                <tr>
                                    <th>id </th>
                                    <th>Title</th>
                                    <th>Distance</th>
                                    <th>Price</th>
                                    <th>actions</th>
                                </tr>
                        </thead>

                        <tbody>
                        @foreach($location as $loca)
                            <tr>
                                <td>{{$loca->id}}</td>
                                <td>{{ $loca->title }}</td>
                                <td>{{ $loca->distance }} km </td>
                                <td>{{ $loca->distance_price }} $</td>
                                <td class="raw form-group">
                                    <a href="{{ route('location.show',$loca->id) }}"
                                            class="btn btn-primary btn-rounded btn-sm my-0">
                                        show
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
