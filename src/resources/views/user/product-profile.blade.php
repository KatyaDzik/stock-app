@extends('layouts.user')

@section('doc-title')
    Главная
@endsection

@section('page-title')
    {{$product->name}}
@endsection

@section('page-content')
    <div class="providers" style="border: 1px solid rgba(201, 201, 201, 0.4); border-radius: 15px; padding: 15px;">
        <h3>Поставщики</h3>
        @foreach($product->invoices as $invoice)
            <h6><a href="{{route('login')}}">{{$invoice->provider->name}}</a></h6>
        @endforeach
    </div>
@endsection
