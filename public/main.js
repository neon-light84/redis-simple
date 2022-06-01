// Тут собрана логика, в отвязки от загруженного дом дерева. Т.е., тут могут быть все что тут происходит,
// не зависит от структуры хтмл документы.

function generateDomList(
    dataObj, // список ключ-значение
    parentDomElem, // Хтмл элемент, куда это все вставить пары из dataObj
    ) {
    let domElemLi;
    for (let key in  dataObj) {
        domElemLi = document.createElement('li');
        domElemLi.innerHTML =
            `<span class="text">${key}: ${dataObj[key]}</span> <a href="#" class="remove" data-key="${key}">delete</a>`;
        parentDomElem.appendChild(domElemLi);
    }
}

// Грамотная реализация всплытия. С учетом вложенных элементов в тот элемент, на который вешаем событие.
// Конкретно в этой задаче излишне, на случай усложнения верстки.
function addListenerWithTarget(
    eventType, // тип собития. Напирмер 'click'
    mainElement, // HTMLElement, внутри которого отслеживаем событие.
    targetSelector, // CSS селектор, от куда должно быть всплытии (<div><a href=#>1111</a></div> - указывать div, сработает, даже если всплытие началось с a)
    callBack, // функция, что делать, при событии. Ей передастся хтмл-элемент, соответствующий селектору  targetSelector, на котором остановилось всплытие
    isPreventDefault = true,
) {
    mainElement.addEventListener(eventType, function (event) {
        if (isPreventDefault) event.preventDefault();
        let elem = event.target.closest(targetSelector);
        if (!elem) return;
        if (!mainElement.contains(elem)) return;
        callBack(elem); // elem - хтмл-элемент, соответствующий селектору  targetSelector
    });
}
