@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="container">

                            <h1>Transfer Money</h1>
                            {!! Form::open(['action' => ['TransfersController@transfer'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {{Form::label('account', 'Account')}}
                                {{Form::text('account')}}
                            </div>
                            <div class="form-group">
                                {{Form::label('amount', 'Amount')}}
                                {{Form::text('amount')}}
                            </div>

                            {{Form::hidden('_method','PUT')}}
                            {{Form::submit('Transfer', ['class'=>'btn btn-primary'])}}
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
