@extends('layout.index')
@section('title', 'Trung Tâm hỗ trợ')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
