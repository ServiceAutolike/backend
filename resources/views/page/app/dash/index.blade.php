@extends('layout.index')
@section('title', 'Trang Chủ')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
