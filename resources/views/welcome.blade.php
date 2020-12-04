@extends('layouts.app')

@section('content')
    <div class="form-inline">
        @foreach($currency['data'] as $row)
            <div class="card" style="width: 18rem; margin:20px" center>
                <div class="card-body">
                    <h5 class="card-title">{{ $row['currency'] }}</h5>
                    <p class="card-text mb-2 text-muted">@lang('buy: '){{ $row['buy'] }}</p>
                    <p class="card-text mb-2 text-muted">@lang('sell: '){{ $row['sell'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection