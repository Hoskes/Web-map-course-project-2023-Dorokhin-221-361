var myMap;
function markPlaces(map) {
    $.ajax({
        url: 'getMapObjects.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Обновление контейнера
            if (response.length > 0) {
                console.log('success');
                // $('#poly-container').html(JSON.stringify(response));
                // console.log($('#count-z').val() + '#');
                // console.log(response);
                // console.log(typeof Number(checkCountRows()));
                // console.log(typeof response + " " + response);
                // console.log();
                var coordinates = [];
                var myPolyline = new ymaps.Polyline(
                    // Указываем координаты вершин ломаной.
                    coordinates
                , {
                    // Описываем свойства геообъекта.
                    // Содержимое балуна.
                    balloonContent: "Ломаная линия"
                }, {
                    // Задаем опции геообъекта.
                    // Отключаем кнопку закрытия балуна.
                    balloonCloseButton: false,
                    // Цвет линии.
                    strokeColor: "#000000",
                    // Ширина линии.
                    strokeWidth: 4,
                    // Коэффициент прозрачности.
                    strokeOpacity: 0.5
                });
                response.forEach(element => {
                    coordinates.push([element['y'],element['x']]);
                    // console.log(typeof element['x']+" "+ element['y']);
                    var myPoint = new ymaps.Placemark([element['y'],element['x']],{
                        balloonContent: element['title']
                    });
                    myMap.geoObjects.add(myPoint);
                });
                myMap.geoObjects.add(myPolyline);
            } else {
                console.log('empty');
            }
        },
        error: function (response) {
            console.log('error');
        }
    });
    // var myPoint = new ymaps.Placemark([55.694843, 37.435023]);
    // myMap.geoObjects.add(myPoint);
}
// Дождёмся загрузки API и готовности DOM.
ymaps.ready(init);

function init() {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").
    myMap = new ymaps.Map('map', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center: [55.76, 37.64], // Москва
        zoom: 10
    }, {
        searchControlProvider: 'yandex#search'
    });
    var myPoint = new ymaps.Placemark([55.694843, 37.435023]);
    myMap.geoObjects.add(myPoint);
    markPlaces(myMap);

}
