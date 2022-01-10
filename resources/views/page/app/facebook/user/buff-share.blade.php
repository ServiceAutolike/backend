@extends('layout.index')
@section('title', 'Buff Share')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
