@extends("layout.main")

@section('title')
Dashboard
@endsection

@section('sidebar')
@include('layout.participant-sidebar')
@endsection

@section('subheader')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
@endsection

@section("content")

@stop