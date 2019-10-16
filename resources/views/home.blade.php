@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Balance: {{Auth::user()->amount}} EUR</div>

                <div class="card-body">
                    <div class="container">

                        <div class="container">
                        History of Sent:<br>
                        @foreach($sentList ?? '' as $sent)
                                <div class="container">
                                    To Account: {{$sent->receiver_id}}<br>
                                    Amount: {{$sent->amount}}<br>
                                </div>
                        @endforeach
                        </div>
                        <div class="container">
                        History of Received:<br>
                        @foreach($receivedList ?? '' as $received)
                                <div class="container">
                                    From Account: {{$received->sender_id}}<br>
                                    Amount: {{$received->amount}}<br>
                                </div>
                        @endforeach
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
