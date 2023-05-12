@extends('layouts.client')
@section('content')
    @include('layouts.inc.clients.slide_banner')
   @livewire('client.home.index')
   @include('layouts.inc.clients.posts')
@endSection
