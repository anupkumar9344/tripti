@extends('layouts.app')

@section('title', $item['title'] . ' | Services | Sahaj Aarogyam')

@section('content')
    @include('partials.detail-single-layout', [
        'item' => $item,
        'allItems' => $allItems,
        'parentTitle' => 'Services',
        'parentUrl' => url('/services'),
        'sidebarTitle' => 'Our Services',
        'detailRoute' => 'services.show',
    ])
@endsection
