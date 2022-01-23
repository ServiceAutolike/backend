@extends('layout.index')
@section('title', 'Danh sách dịch vụ')
@section('content')
    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>
@endsection
