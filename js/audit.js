function auditor_inspect() {

    var url = './audit.php';

    jQuery.ajax({
        url: url,
        // data: parameter,
        dataType: 'json',
        success: audit_check
    });
}

function audit_check(data, status, xhr) {
    if (data['status'] != 'OK')
        return;

    jQuery("#result").addClass("well");
    var id, html;

    if (data['data'].length > 0) {
        html = "<caption><h3>出错账单信息表</h3></caption><tr><th>出错账单号</th><th>账单金额</th><th>买家实际所付金额</th></tr>";
        jQuery("#order_table").addClass("table-hover");
        jQuery("#order_table").append(html);
        for (id in data['data']) {
            if (data['data'][id]['price'] != data['data'][id]['money']) {
                html = "<tr class='warning'><td>" + data['data'][id]['order_id'] +
                    "</td><td>" + data['data'][id]['money'] +
                    "</td><td>" + data['data'][id]['price'] + "</td></tr>";

                jQuery('#order_table').append(html);

            }
        }
    }
    else {
        html = "<caption><h3>审计通过</h3></caption>";

        jQuery("#order_table").append(html);
    }

}
