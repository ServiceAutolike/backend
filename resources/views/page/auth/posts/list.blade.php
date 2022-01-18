@extends('layout.index')
@section('title', 'Bài viết')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection

