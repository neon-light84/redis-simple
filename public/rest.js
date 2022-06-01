// Тут не должно быть работы с DOM.

var endPointCrud = 'http://redis-simple.local.me/api/';

async function restRequest (token, url, method) {
    const fetchInit = {
        method: method,
        headers: {Authorization: `Bearer ${token}`},
    };
    // следующая хитрая конструкция, сделана вместо стандартного .then().then().catch , что бы получить в одном
    // блоке кода, и хттп статус и тело ответа. В рамках задачи излишне, но хороший REST, возвращает статусы
    // ответа именно в хттп статусе. Опирался именно на него, и только на него. поля status, code, которые в ТЗ
    // игнорировал. Их прислал с бэка, только потому что они в ТЗ указаны.
    // Такой подход увеличил кол-во кода, но приблизил код к продакшену.
    try {
        const response = await fetch(url, fetchInit);
        const dataResponse = await response.json();

        if (Math.floor(response.status / 100) === 2) { // Другими словами, статусы не 2xx
            return {
                isSuccess: true,
                data: dataResponse.data,
            }
        }
        else {
            return {
                isSuccess: false,
                message: dataResponse.data.message,
            }
        }
    }
    catch (ex) {
        // на продакшене, хорошо бы, еще куда то залогировать.
        return {
            isSuccess: false,
            message: "Сервер недоступен или вернул не допустимые данные.",
        }
    }
}

function restReadAll(token) {
    return restRequest(
        token,
        endPointCrud + `redis/`,
        'GET'
    );
}


function restDelete(token, key) {
    return restRequest(
        token,
        endPointCrud + `redis/${key}`,
        'DELETE'
    );
}
