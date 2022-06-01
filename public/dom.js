// Скрипты затрагивающие работу с DOM загруженного документа. По возможности, логика исключена.


// DOM элементы, с которыми будем работать
let domDataList = document.getElementById('data-list');

// Клик на удаление
// Почему понадобилось именно всплытие, а не навешивание на каждый из элементов. Что бы не было кучи слушателей.
// Каждый слушатель занимает ресурсы.
addListenerWithTarget(
    'click',
    domDataList,
    '.remove',
    function (elem) {
        restDelete(token, elem.dataset.key).then(function (objData) {
            if (objData.isSuccess) {
                window.alert('Данные удалены');
            }
            else {
                window.alert('Упс, ' + objData.message);
            }
            reloadDataList();
        })
    });


// Перезагрузка списка, полученного по REST
function reloadDataList() {
    restReadAll(token).then(function (objData) {
        domDataList.innerHTML = '';
        if (objData.isSuccess) {
            generateDomList(objData.data, domDataList);
        }
        else {
            window.alert('Упс, ' + objData.message);
        }
    });
}
