@extends('layout.index')
@section('title', 'Danh sách hỗ trợ ')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
