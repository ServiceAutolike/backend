@extends('layout.index')
@section('title', 'Dash board')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
