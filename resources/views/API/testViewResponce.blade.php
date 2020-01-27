@extends('API.Capsule')

@section('body')


@foreach ($Data_Accounts as $Data)
  <p>Это строка {{$Data}}</p>
@endforeach

@stop