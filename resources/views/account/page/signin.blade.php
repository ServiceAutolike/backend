@extends('account.layout.index')
@section('title', 'Login')
@section('content')
        <transition name="page" mode="out-in">
            <router-view></router-view>
        </transition>
@endsection
