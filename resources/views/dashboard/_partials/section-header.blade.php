@php
    $segments = \Illuminate\Support\Facades\Request::segments();
@endphp
<div class="section-header">
    <h1>@yield('title')</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ url('/') }}">Dashboard</a></div>
        @foreach($segments as $segment)
            <div class="breadcrumb-item active">{{ ucfirst($segment) }}</div>
        @endforeach
    </div>
</div>
