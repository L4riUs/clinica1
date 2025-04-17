function get(url, callback=null, method='GET') {
    const request = new XMLHttpRequest();
    request.open(method,url, false);
    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            console.log(request.response);
            
            callback(JSON.parse(request.response));
        } else {
            console.log('Error al obtener los datos');
            console.log(request.response);
        }
    }
    request.send();
}