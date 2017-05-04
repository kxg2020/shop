$(function(){
    $('#pcheck').change(function(){
        // 获取他的下级
        var _id = $(this).val();
        if(!_id){
            clearSelect('ccheck');
        }
        clearSelect('acheck');
        selectChildLocations(_id, 'ccheck');
    });
    $('#ccheck').change(function(){
        // 获取他的下级
        var _id = $(this).val();
        if(!_id){
            clearSelect('acheck');
        }
        selectChildLocations(_id, 'acheck');
    });


    // 异步保存收货人信息
    $('.saveAddress').click(function(){
        $('#addAddress').submit();
    })

    // 编辑收货地址
    $('.editAddress').click(function(){
        $('#addAddress').removeClass('none');
        var _id = $(this).attr('data-id');
        $.getJSON('/User/getLocationInfo/id/'+_id+'.html', '', function(result){
            if(result.status == 1){
                $('#addAddress').append('<input name="id" type="hidden" value="' + _id + '" />');
                $('#addAddress').find('input[name="name"]').val(result.addressInfo.name);
                $('#addAddress').find('input[name="address"]').val(result.addressInfo.address);
                $('#addAddress').find('input[name="phone"]').val(result.addressInfo.phone);
                $('#pcheck').val(result.addressInfo.p_id);

                var _options = '<option value="">请选择</option>';
                $.each(result.c, function (i, v){
                    var _selected = "";
                    if(v.id == result.addressInfo.c_id){
                        _selected = 'selected';
                    }
                    _options += '<option value="'+ v.id +'" '+ _selected +'>'+ v.name +'</option>';
                });

                $('#ccheck').html(_options);

                var _options = '<option value="">请选择</option>';
                $.each(result.a, function (i, v){
                    var _selected = "";
                    if(v.id == result.addressInfo.a_id){
                        _selected = 'selected';
                    }
                    _options += '<option value="'+ v.id +'" '+ _selected +'>'+ v.name +'</option>';
                });

                $('#acheck').html(_options);
            }
        })
    })

    $('.new_address').click(function(){
        $('#addAddress').find('input').val("");
        clearSelect('ccheck');
        clearSelect('acheck');
        $('#pcheck').val("");
        $('#addAddress').find('input[name="id"]').remove();
    })


    getOrderMoney();

});

/**
 * 根据当前ID找儿子.....
 * @param _id
 */
function selectChildLocations(_id, selectName){
    $.getJSON('/User/getChildLocations.html', {id: _id}, function(result){
        if(result.status == 1){
            // 成功找到数据
            var _options = '<option value="">请选择</option>';
            $.each(result.data, function (i, v){
                _options += '<option value="'+ v.id +'">'+ v.name +'</option>';
            });

            $('#' + selectName).html(_options);
        }
    });
}

function clearSelect(selectName){
    var _options = '<option value="">请选择</option>';
    $('#' + selectName).html(_options);
}


function editDelivery(){
    var _name = $('input[name="delivery"]:checked').attr('data-name');
    $('#delivery').html(_name);
    $('.delivery_select').hide();
    $('.delivery_info').show();
    $('#delivery_modify').show();
    getOrderMoney();
}
function editPayment(){
    var _name = $('input[name="pay"]:checked').attr('data-name');
    $('#paymentName').html(_name);
    $('.pay_select').hide();
    $('.pay_info').show();
    $('#pay_modify').show();
}

function editInvoice(){
    var _type = $('input[name="invoiceType"]:checked').val();
    var _companyName = $('input[name="invoiceName"]').val();
    if(_type == '个人'){
        _companyName = '';
        $('input[name="invoiceName"]').val("");
    }
    $('#invoiceName').html(_type + '发票' + _companyName);

    var _content = $('input[name="content"]:checked').val();
    $('#invoiceContent').html('内容：'+_content);


    $('.receipt_select').hide();
    $('.receipt_info').show();
    $('#receipt_modify').show();
}


// 获取订单应该支付的价格
function getOrderMoney(){
    var _d_price = $('input[name="delivery"]:checked').attr('data-price');
    var _orderAllMoney = $('#orderAllMoney').attr('data-price');
    var _orderMoney = _orderAllMoney*1 + _d_price*1;
    $('.d_price').html('￥'+ _d_price);
    $('.orderMoney').html('￥'+ _orderMoney);
}


/**
 * 点击提交订单按钮，执行的函数，
 * 将获取的数据，传递给处理订单的页面
 * @returns {boolean}
 */
function submitOrder(){
    // 获取收货人地址（获取的ID）
    var _address_id = $('input[name="address_id"]:checked').val();

    // 获取送货方式 ID
    var _delivery = $('input[name="delivery"]:checked').val();

    // 支付方式 ID
    var _pay = $('input[name="pay"]:checked').val();

    // 发票信息
    var _invoiceName = $('input[name="invoiceType"]:checked').val();
    var _invoiceCompanyName = $('input[name="invoiceName"]').val();
    var _invoiceContent = $('input[name="content"]:checked').val();

    // 定义处理订单的控制器和操作。。。。
    var _url = '/Order/submit.html';

    // 发送AJAX请求
    $.ajax({
        // 申明请求类型
        type: 'POST',
        // 地址
        url: _url,
        // 封装传递给请求页面的数据（对象）
        data: {
            address_id: _address_id,
            delivery: _delivery,
            pay: _pay,
            invoiceName: _invoiceName,
            invoiceCompanyName: _invoiceCompanyName,
            invoiceContent: _invoiceContent
        },
        // 申请接收的数据应该是 JSON格式 (XML TEXT)
        dataType: 'Json',
        // 请求成功的回调函数
        success: function(result){
            // result 服务器返回的结果（对象）
            if(result.status == 0){
                // 失败 弹出提示信息
                alert(result.msg);
            }else{
                // 成功要执行跳转
                location.href = result.url;
            }
        },
        error: function(){}
    })


}