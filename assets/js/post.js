function post(url, callback=None, method='POST', data=null) {
    const request = new XMLHttpRequest();
    request.open(method,url, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            callback(JSON.parse(request.response));
        } else {
            console.error('Error al eliminar el insumo');
        }
    }
    request.send(data);
}