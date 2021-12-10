@extends('layout.index')
@section('title', 'Dash board')
@section('content')
    <div class="mb-4">
        <div class="card rounded-12 shadow-dark-80 border border-gray-200 h-100">
            <div class="card-body p-0">
                <div class="p-3 p-xl-4">
                    <div class="pt-2 px-md-3 px-xl-0 px-xxl-3">
                        <div class="col ps-0 ps-md-1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên tài khoản</th>
                                    <th scope="col">Số điểm</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $items)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{$items->name}}</td>
                                        <td>{{$items->point}} Đồng</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$items->id}}">
                                                Nạp tiền
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$items->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content shadow-dark-80">
                                                <div class="modal-header border-0 pb-0 align-items-start ps-4">
                                                    <h5 class="modal-title pt-3" id="exampleModalLabel">Nạp tiền</h5>
                                                    <button type="button" class="btn btn-icon p-0" data-bs-dismiss="modal" aria-label="Close">
                                                        <svg data-name="icons/tabler/close" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                            <rect data-name="Icons/Tabler/Close background" width="16" height="16" fill="none"></rect>
                                                            <path d="M.82.1l.058.05L6,5.272,11.122.151A.514.514,0,0,1,11.9.82l-.05.058L6.728,6l5.122,5.122a.514.514,0,0,1-.67.777l-.058-.05L6,6.728.878,11.849A.514.514,0,0,1,.1,11.18l.05-.058L5.272,6,.151.878A.514.514,0,0,1,.75.057Z" transform="translate(2 2)" fill="#1e1e1e"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <form action="{{route('user.recharge')}}" method="post">
                                                    @csrf
                                                    <div class="modal-body pt-2 px-4">
                                                        <input type="hidden" name="id_user" value="{{$items->id}}">
                                                        <div class="mb-3">
                                                            <label for="point" class="form-label">Số điểm</label>
                                                            <input type="text" class="form-control" id="point"
                                                                   placeholder="Nhập điểm" name="point">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light px-2"
                                                                data-bs-dismiss="modal"><span class="px-1">Cancel</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary px-2 ms-2"><span
                                                                class="px-1">Nạp</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
