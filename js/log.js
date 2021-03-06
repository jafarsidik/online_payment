(function($){
    $('#log').click(function(e) {
        e.preventDefault();
        query_log(1);
    });

    $('#export').click(function(e) {
        e.preventDefault();
        query_log(2);
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
        var time = cur_year + '-' + cur_month + '-' + cur_date;
        return time;
    }

    function query_log(cond) {

        var url = './get_log.php';
        var startime = '';
        var endtime = '';

        if (startDateTextBox.val() != '') {
            startime = format_date(startDateTextBox.datetimepicker('getDate'));
        }
        if (endDateTextBox.val() != '') {
            endtime = format_date(endDateTextBox.datetimepicker('getDate'));
        }
        var parameter = {date1: startime, date2: endtime};

        if (cond == 1) {
            jQuery.ajax({
                url: url,
                data: parameter,
                dataType: 'json',
                success: get_log
            });
        }
        else if (cond == 2) {
            jQuery.ajax({
                url: url,
                data: parameter,
                dataType: 'json',
                success: export_log
            });
        }

    }

    function export_log(data, status, xhr) {
        if (data['status'] != 'OK')
            return;

        var id, contents="";
        if (data['data'].length > 0) {
            for (id in data['data']) {
                contents += data['data'][id]['order_id'] + " " +
                    data['data'][id]['buyer_id'] + " " + data['data'][id]['seller_id'] +
                    " " + data['data'][id]['total_amount'] + " " + data['data'][id]['status'] +
                    " " + data['data'][id]['trade_time'] + "\n";
            }
        }
        else
            return;

        // console.log(contents);
        $.generateFile({
            filename    : 'export.txt',
            content     : contents,
            script      : 'download.php'
        });

    }

    function get_log(data, status, xhr) {
        if (data['status'] != 'OK')
            return;

        var id, html;
        jQuery("#log_table").empty();
        if (data['data'].length > 0) {

            html = "<caption><h3>上一日交易信息</h3></caption><tr><th>订单号</th><th>买家ID</th><th>卖家ID</th><th>交易金额</th><th>订单状态</th><th>交易时间</th></tr>";

            jQuery("#log_table").addClass("table-hover");
            jQuery("#log_table").append(html);

            for (id in data['data']) {

                html = "<tr class='warning'><td>" + data['data'][id]['order_id'] +
                    "</td><td>" + data['data'][id]['buyer_id'] +
                    "</td><td>" + data['data'][id]['seller_id'] + "</td><td>" +
                    data['data'][id]['total_amount'] + "</td><td>" +
                    data['data'][id]['status'] + "</td><td>" + data['data'][id]['trade_time']
                    + "</td></tr>";

                jQuery('#log_table').append(html);

            }
        }
        else {

            html = "<caption><h3>没有交易信息</h3></caption>";
            // jQuery("#log_table").addClass("table-hover");
            jQuery("#log_table").append(html);
        }

    }

})(jQuery);
