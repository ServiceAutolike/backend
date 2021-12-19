@extends('layout.index')
@section('title', 'Lịch Sử Order')
@section('content')

    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>

@endsection
