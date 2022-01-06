@extends('layout.index')
@section('title', 'Lịch Sử Nạp Tiền')
@section('content')
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
        <!--begin::Messenger-->
        <div class="card" id="kt_chat_messenger">
            <!--begin::Card header-->
            <div class="card-header" id="kt_chat_messenger_header">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <span class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-5 lh-1 symbol symbol-35px symbol-circle">
                            <img alt="Pic" src="{{asset("/storage/".$data->user->image)}}" />
                            {{$data->subject}}
                        </span>
                        <!--begin::Info-->
                        <div class="mb-2 lh-1">
                            <span class="badge badge-success badge-circle w-5px h-5px me-1"></span>
                            <span class="fs-7 fw-bold text-gray-900">Loại hỗ trợ :</span>
                            <span class="badge {{$data->class_service}} my-1">{{$data->service}}</span>
                        </div>
                        <div class="mb-2 lh-1">
                            <span class="badge badge-success badge-circle w-5px h-5px me-1"></span>
                            <span class="fs-7 fw-bold text-gray-900">Mô tả :</span>
                            <span class="fs-7 fw-bold p-2 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end">{{$data->description}}</span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <form action="{{route('support.set')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <input type="hidden" name="status" value="{{$data->status == 2 ? 1 : 2}}">
                        <button type="submit" class="btn {{$data->status == 2 ? "btn-success" : "btn-danger"}} btn-sm">{{$data->status == 2 ? "Mở lại hỗ trợ" : "Đóng hỗ trợ"}}</button>
                    </form>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body" id="kt_chat_messenger_body">
                <!--begin::Messages-->
                <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px">

                    <!--begin::Message(out)-->
                    @foreach($dataChat as $item)
                        <div class="d-flex mb-10  {{$item->id_user == auth()->user()->id ? "justify-content-end" : "justify-content-start" }}">
                            <!--begin::Wrapper-->
                            @if($item->id_user == auth()->user()->id)
                            <div class="d-flex flex-column align-items-end">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="me-3">
                                        <span class="text-muted fs-7 mb-1">{{convertTime($item->created_at)}}</span>
                                        <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">
                                            {{$item->user->name}}
                                        </a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="{{asset("storage/".$item->user->image)}}" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">
                                    {{$item->message}}
                                </div>
                                <!--end::Text-->
                            </div>
                             @else
                                <div class="d-flex flex-column align-items-start">
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center mb-2">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <img alt="Pic" src="{{asset("storage/".$item->user->image)}}" />
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Details-->
                                        <div class="ms-3">
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{$item->user->name}}</a>
                                            <span class="text-muted fs-7 mb-1">{{convertTime($item->created_at)}}</span>
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Text-->
                                    <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">
                                        {{$item->message}}
                                    </div>
                                    <!--end::Text-->
                                </div>
                        @endif
                            <!--end::Wrapper-->
                        </div>
                    @endforeach

                    <!--end::Message(out)-->

                    <!--end::Message(template for in)-->
                </div>
                <!--end::Messages-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            @if($data->status !== 2)
            <div class="card-footer pt-4" >
                <!--begin::Input-->
                <form action="{{route('support.chat')}}" method="post">
                    @csrf
                    <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                    <input type="hidden" name="code_chat" value="{{$data->code_chat}}">
                    <textarea class="form-control form-control-flush mb-3" rows="1" name="message" placeholder="Gõ một tin nhắn"></textarea>
                    <!--end::Input-->
                    <!--begin:Toolbar-->
                        <div class="d-flex flex-stack">
                    <!--begin::Actions-->
                        <div class="d-flex align-items-center me-2">
                            <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                                <i class="bi bi-paperclip fs-3"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                                <i class="bi bi-upload fs-3"></i>
                            </button>
                        </div>
                        <!--end::Actions-->
                        <!--begin::Send-->
                        <button class="btn btn-primary" type="submit" >Gửi</button>
                        <!--end::Send-->
                    </div>
                </form>
                <!--end::Toolbar-->
            </div>
        @endif
            <!--end::Card footer-->
        </div>
        <!--end::Messenger-->
    </div>
@endsection
