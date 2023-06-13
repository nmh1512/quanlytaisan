// empty html
function isEmpty(el) {
    return !$.trim(el.html());
}
function getActionButtons(data) {
    var currentRoute = route().current();
    currentRoute = currentRoute.replace('_index', '')
    var editRoute = `${currentRoute}_edit`;
    var deleteRoute = `${currentRoute}_delete`;
    var disableRoute = `${currentRoute}_disable`;
    const dataActions = {
        edit: {
            route: Ziggy.routes.hasOwnProperty(editRoute) ? route(editRoute, data.id) : '',
            title: "Sửa",
            style: "btn-primary",
            icon: '<i class="far fas fa-edit"></i>',
            action: 'edit'

        },
        delete: {
            route: Ziggy.routes.hasOwnProperty(deleteRoute) ? route(deleteRoute, data.id) : '',
            title: "Xóa",
            style: "btn-danger",
            icon: '<i class="far fa-trash-alt"></i>',
            action: 'delete'
        },
        disable: {
            route: Ziggy.routes.hasOwnProperty(disableRoute) ? route(disableRoute, data.id) : '',
            title: data.status == 1 ? "Vô hiệu hóa" : "Kích hoạt",
            style: "btn-warning",
            icon: data.status == 1 ? '<i class="fas fa-lock"></i>' : '<i class="fas fa-lock-open"></i>',
            action: data.status == 1 ? 'disable' : 'enable'

        },
    };
    let buttons = "";
    $.each(data.actions, (i, v) => {
        var route = dataActions[v].route;
        var title = dataActions[v].title;
        var style = dataActions[v].style;
        var icon = dataActions[v].icon;
        var action = dataActions[v].action;

        buttons += `
                    <button data-href="${route}" data-id="${data.id}" data-action="${action}" title="${ title }" type="button" class="btn ${style} btn-sm m-1 btn-action" data-toggle="modal" data-target="#modalCenter">
                        ${icon}
                    </button>
                    `;
    });
    return buttons;
}
