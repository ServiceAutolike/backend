@extends('layout.index')
@section('title', 'Hội thoại')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
