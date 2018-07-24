$(document).ready(function () {
    loadItemsList();

});

function loadItemsList() {
    $.getJSON("/api/v1/admin/item/list", function (result) {
        if (result.success === '1') {
            let str = '';
            $(result.content).each(function (i, item) {
                let buttonStr =
                    '<button type="button" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Edit Item">' +
                    '<i class="material-icons">edit</i>' +
                    '</button>' +
                    '<button type="button" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" onclick="delItem(' + item.id + ')" data-original-title="Remove Item">' +
                    '<i class="material-icons">close</i>' +
                    '<div class="ripple-container"></div></button>';

                str += `<tr><td>${item.id}</td><td>${item.name}</td><td>${item.description}</td><td class="td-actions">${buttonStr}</td></tr>`;
            });
            $(".items-list").html(str);
        }
    });
}

function delItem(id) {
    swal({
        title: "你确定吗",
        text: "该项目将会被删除",
        icon: "warning",
        buttons: ["算了", "删了吧"],
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var data = {id: id};
                $.getJSON("/api/v1/admin/item/del", data, function (result) {
                    if (result.success === '1') {
                        swal("该项目已经被删除", {
                            icon: "success",
                        });
                    }
                });
            }
        });

    swal({
            title: "你确定吗？",
            text: "该项目将会被删除",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "删了吧!",
            closeOnConfirm: false
        },
        function () {

        });
}
