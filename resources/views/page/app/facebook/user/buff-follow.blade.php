@extends('layout.index')
@section('title', 'Buff Sub/Người Theo Dõi')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
