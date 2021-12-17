var sitePrice = $('#sitePrice').val();
var minNumber = 20;
var maxNumber = 200000;
var isCheckID = false;
var id_fb, name_fb, post_fb = '';
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toastr-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
jQuery(document).ready(function ($) {
    $('#form-create').validate({
        rules: {
            'post_id': {
                required: true,
            },
            'fanpage_id': {
                required: true,
            },
            'type': {
                required: true,
            },
            'reaction': {
                required: true,
            },
            'reaction[]': {
                required: true,
            },
            'comments': {
                required: true,
                comments: true,
            },
            'reviews': {
                required: true,
                reviews: true,
            },
            'number_seeding': {
                required: true,
                min: 20,
                max: 100000
            },
            'time_to_live': {
                required: true
            },
            'time_to_use': {
                required: true
            },
            'live_per_day': {
                required: true
            },
            'total_live': {
                required: true,
                min: 5
            },
            'price': {
                required: true,
                min: 50
            },
        },
        messages: {
            'post_id': {
                required: 'Vui lòng nhập trường !',
            },
            'fanpage_id': {
                required: 'Vui lòng nhập trường !',
            },
            'type': {
                required: 'Vui lòng chọn  server!',
            },
            'reaction': {
                required: 'Vui lòng chọn cảm xúc!',
            },
            'reaction[]': {
                required: 'Vui lòng chọn cảm xúc!',
            },
            'comments': {
                required: 'Vui lòng nhập bình luận!'
            },
            'reviews': {
                required: 'Vui lòng nhập đánh giá !'
            },
            'number_seeding': {
                required: 'Vui lòng nhập số lượng cần tăng!',
                min: 'Số lượng phải lơn  {0}.',
                max: 'Số lượng phải nhỏ  {0}.',
            },
            'price': {
                required: 'Vui lòng nhập giá tiền trên mỗi tương tác!',
                min: 'Vui lòng nhập giá tiền lơn {0}.'
            },
        },
        submitHandler: function () {
            var listReaction = getReactionChecked("reaction");
            if(listReaction == null) {
                Swal.fire(
                    'Có lỗi xảy ra!',
                    'Bạn phải chọn ít nhất 1 cảm xúc!',
                    'error'
                )
            }
            else if(isCheckID == false) {
                Swal.fire(
                    'Có lỗi xảy ra!',
                    'Bạn phải nhập một ID hoặc URL hợp lệ!',
                    'error'
                )
            }
            else {
                var data = {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "post_id": $('#post_id').val(),
                    "sv": $('input[type=radio][name=sv]:checked').val(),
                    "reaction": listReaction,
                    "type_check": $('#type_check').val(),
                    "number_seeding": $('#number_seeding').val(),
                    "sitePrice": $('#sitePrice').val(),
                    "warranty": $('#warranty').val()

                };
                Swal.fire({
                    title: 'Xác Nhận',
                    text: 'Bạn có chắc chắn muốn tạo đơn!',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tạo Tiến Trình',
                    cancelButtonText: 'Hủy',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        var form = $('#form-create');
                        var url = form.attr('action');
                        var method = form.attr('method');
                        return $.ajax({
                            type: method,
                            url: url,
                            data: data,
                            dataType: 'json',
                            success: function (response) {
                                console.log(response.messages);
                                if(response.code  != 400) {
                                    Swal.fire("Thành công!", response.messages, response.status);
                                }
                                else {
                                    Swal.fire("Có lỗi xảy ra!", response.messages, response.status);
                                }

                            },
                            error: function (xhr, status, error) {
                                var response = JSON.parse(xhr.responseText);
                                Swal.fire(
                                    'Có lỗi xảy ra!',
                                    response.messages,
                                    'error'
                                )
                            }
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                });
            }
        }
    });
});
function getReactionChecked(name) {
    var idReaction = document.getElementsByName(name);
    var listReactionchecked = [];
    for (var i=0; i<idReaction.length; i++) {
        if (idReaction[i].checked) {
            listReactionchecked.push(idReaction[i].value);
        }
    }
    return listReactionchecked.length > 0 ? listReactionchecked : null;
}

$('#number_seeding, #price').on('input', function() {
    changeTotal();
});
$('input[type=radio][name=sv]').on('change', function() {
    var sv = $('input[type=radio][name=sv]:checked').val();
    console.log(sv)
    if(sv == "sv_like") {
        $('.wow, .love, .sad, .haha, .angry, .care').addClass("d-none");
    }
    else {
        $('.wow, .love, .sad, .haha, .angry, .care').removeClass("d-none");
    }
    changeTotal(true);
});

$('input[type=radio][name=sv]:not(:disabled):first').prop('checked', true).change();


function changeReaction() {
    var type = $('input[type=radio][name=sv]:checked').val();
    if(type == "sv_like") {
        $('#wow, #love, #sad, #haha, #angry').hide();
    }
}

function changeTotal(changeType = false) {
    var sv = $('input[type=radio][name=sv]:checked').val();
    if(sv == "sv_reaction") {
        var type = "cảm xúc";
        $('#sitePrice').val(70);

    }
    else {
        var type = "like";
        $('#sitePrice').val(50);
    }
    var price = $('#sitePrice').val();
    var newPrice = price;
    newPrice = Math.ceil(newPrice);
    if (changeType) $('#sitePrice').val(price);
    var number_seeding = $('#number_seeding').val();
    var total = newPrice * number_seeding;
    $('#priceServices').text(newPrice);
    $('#type').text(type);
    $('#type2').text(type);
    $('#number').text(number_seeding);
    $('#total_price').text(total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}));
}

/// check ID Facebook
$("#post_id").on("change key", function () {
    $('#loadCheck').addClass('spinner spinner-success spinner-right');
    var typecheck = $('#type_check').val();
    var bodyData = {
        "url": $('#post_id').val(),
        "type": typecheck
    }
    $.ajax({
        url: '/api/find-id',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(bodyData),
        success: function (response) {
            const result = JSON.parse(JSON.stringify(response))
            $('#loadCheck').removeClass('spinner spinner-success spinner-right');
            if (result.code == 200) {
                isCheckID = true;
                toastr.success("Lấy ID Facebook thành công!");
                $('#post_id').val(result.id);
            } else {
                isCheckID = false;
                toastr.error(result.message);
            }

        },
        error: function () {
            $('#loadCheck').removeClass('spinner spinner-success spinner-right');
            toastr.error("URL lỗi hoặc ID không tồn tại, vui lòng kiểm tra lại!");
            $('#result').hide();
        }
    });
});
