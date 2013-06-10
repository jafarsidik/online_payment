(function($){
    $('#query').click(function(e) {
        e.preventDefault();
        auditor_inspect();
    });

    var startDateTextBox = $('#starttime');
    var endDateTextBox = $('#endtime');

    startDateTextBox.datetimepicker();
    endDateTextBox.datetimepicker();

    function format_date(d) {
        var cur_date = d.getDate();
        var cur_month = d.getMonth() + 1;
        var cur_year = d.getFullYear();
        var cur_hour = d.getHours();
        var cur_minute = d.getMinutes();
        var cur_second = d.getSeconds();
        var time = cur_year + '-' + cur_month + '-' + cur_date + ' ' + cur_hour + ':' + cur_minute + ':' + cur_second;
        return time;
    }

    function auditor_inspect() {

        var url = './inquery.php';

        var buyer = $('input[name="buyer"]').val();
        var bound = $('input[name="bound"]:checked').val();
        var startime = '';
        var endtime = '';
        if (startDateTextBox.val() != '') {
            startime = format_date(startDateTextBox.datetimepicker('getDate'));
        }
        if (endDateTextBox.val() != '') {
            endtime = format_date(endDateTextBox.datetimepicker('getDate'));
        }

        jQuery.ajax({
            url: url,
            data: {buyer: buyer, bound : bound, st: startime, et : endtime},
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
