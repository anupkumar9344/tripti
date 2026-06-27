@extends('layouts.app')

@section('title', $item['title'] . ' | Treatment | Sahaj Aarogyam')

@section('content')
    @include('partials.detail-single-layout', [
        'item' => $item,
        'allItems' => $allItems,
        'parentTitle' => 'Treatment',
        'parentUrl' => url('/treatment'),
        'sidebarTitle' => 'What We Treat',
        'detailRoute' => 'treatment.show',
    ])
@endsection
