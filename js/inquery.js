(function($){
    $('#query').click(function(e) {
        e.preventDefault();
        auditor_inspect();
    });


    function auditor_inspect() {

        var url = './inquery.php';

        var buyer = $('input[name="buyer"]').val();
        var bound = $('input[name="bound"]:checked').val();

        jQuery.ajax({
            url: url,
            data: {buyer: buyer, bound : bound},
            dataType: 'json',
            success: order_show
        });
    }

    function order_show(data, status, xhr) {
        if (data['status'] != 'OK')
            return;

        // var r = $('#result');
        // r.find("tr:gt(0)").remove();
        jQuery("#order_table").empty();

        if (data['data'].length > 0) {
            html = "<caption><h3>订单表</h3></caption><tr><th>订单号</th><th>日期</th><th>类型</th><th>商品编号</th><th>状态</th><th>单价</th><th>总价</th><th>折扣</th><th>数量</th><th>买家</th><th>地址</th><th>卖家</th></tr>";

            jQuery("#order_table").addClass("table-hover");
            jQuery("#order_table").append(html);

            for (var id in data['data']) {
                var html = "<tr class='success'>";
                for (var d in data['data'][id])
                    html += '<td>' + data['data'][id][d] + '</td>';

                html += "</tr>";
                // r.append(html);
                jQuery('#order_table').append(html);

            }
        }
        else {
            html = "<caption><h3>没有符合条件的订单信息</h3></caption>";
            // jQuery("#log_table").addClass("table-hover");
            jQuery("#log_table").append(html);
        }

    }
})(jQuery);
