@extends('layout.index')
@section('title', 'Dash board')
@section('content')

        <div class="mb-4">
            <div class="card rounded-12 shadow-dark-80 border border-gray-200 h-100">
                <div class="card-body p-0">
                    <div class="p-3 p-xl-4">
                        <div class="pt-2 px-md-3 px-xl-0 px-xxl-3">
                            <div class="col ps-0 ps-md-1">
                                <form method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="post">
                                    <input type="text" name="link">
                                    <button type="submit" class="btn btn-danger">submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
