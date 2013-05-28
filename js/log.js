function query_log() {

    var url = './query_log.php';

    jQuery.ajax({
        url: url,
        // data: parameter,
        dataType: 'json',
        success: get_log
    });
}

function get_log(data, status, xhr) {
    if (data['status'] != 'OK')
        return;

    // jQuery("#order_table").empty();

    jQuery("#log_table").empty();

    var id, html;

    if (data['data'].length > 0) {
        html = "<caption><h3>上一日交易信息</h3></caption><tr><th>订单号</th><th>买家ID</th><th>卖家ID</th><th>交易金额</th><th>订单状态</th><th>交易时间</th></tr>";
        // jQuery("#order_table").addClass("table-hover");
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
        html = "<h3>没有订单消息。</h3>";
        jQuery('#result').append(html);
    }

}
