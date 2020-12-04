@extends('layouts.app')

@section('content')
    <center>
        <p>@lang('There is token')</p>
        <!-- The text field -->
        <input type="text" value="{{ $token }}" id="myInput" readonly size="50">
        <!-- The button used to copy the text -->
        <button onclick="copy()">Copy text</button>
    </center>
@endsection

