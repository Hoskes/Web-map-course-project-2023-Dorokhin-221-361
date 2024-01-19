// Функция для определения ориентации трех точек
function orientationT(p, q, r) {
    let val = (q[1] - p[1]) * (r[0] - q[0]) - (q[0] - p[0]) * (r[1] - q[1]);
    if (val == 0) {
        return 0; // Коллинеарные точки
    } else if (val > 0) {
        return 1; // Против часовой стрелки
    } else {
        return 2; // По часовой стрелке
    }
}

// Функция для построения выпуклой оболочки
function convexHull(points) {
    let n = points.length;
    if (n < 3) {
        return []; // Минимальное количество точек для построения выпуклой оболочки - 3
    }

    // Находим самую левую точку
    let leftmost = 0;
    for (let i = 1; i < n; i++) {
        if (points[i][0] < points[leftmost][0]) {
            leftmost = i;
        }
    }

    let hull = [];
    let p = leftmost;
    let q;

    do {
        hull.push(points[p]);
        q = (p + 1) % n;

        for (let i = 0; i < n; i++) {
            if (orientationT(points[p], points[i], points[q]) == 2) {
                q = i;
            }
        }

        p = q;
    } while (p != leftmost);

    return hull;
}



let data = [];
let hullCoordinates = [];
var myMap;
let color = '';
let preNum;
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function markPlaces(map) {
    $.ajax({
        url: 'getMapObjects.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Обновление контейнера
            if (response.length > 0) {
                console.log('success');
                var coordinates = [];
                response.forEach(element => {
                    if(element['title']!=null){
                    data.push(element);
                    }
                    if (color == '' | preNum != element['title']) {
                        preNum = element['title'];
                        // console.log(hullCoordinates);
                        if (hullCoordinates.length > 0 ) {
                            var myGeoObject = new ymaps.GeoObject({
                                // Описываем геометрию геообъекта.
                                geometry: {
                                    // Тип геометрии - "Многоугольник".
                                    type: "Polygon",
                                    // Указываем координаты вершин многоугольника.
                                    coordinates: [
                                        // Координаты вершин внешнего контура.
                                            convexHull(hullCoordinates)
                                        ,
                                        // Координаты вершин внутреннего контура.
                                        
                                            convexHull(hullCoordinates)
                                        
                                    ],
                                    // Задаем правило заливки внутренних контуров по алгоритму "nonZero".
                                    fillRule: "nonZero"
                                },
                                // Описываем свойства геообъекта.
                                properties:{
                                    // Содержимое балуна.
                                    balloonContent: "Многоугольник"
                                }
                            }, {
                                // Описываем опции геообъекта.
                                // Цвет заливки.
                                fillColor: color,
                                // Цвет обводки.
                                strokeColor: '#0000FF',
                                // Общая прозрачность (как для заливки, так и для обводки).
                                opacity: 0.2,
                                // Ширина обводки.
                                strokeWidth: 5,
                                // Стиль обводки.
                                strokeStyle: 'shortdash'
                            });
                        
                            // Добавляем многоугольник на карту.
                            myMap.geoObjects.add(myGeoObject);
                        }
                        hullCoordinates = [];


                        color = getRandomColor();
                    }
                    hullCoordinates.push([element['y'], element['x']]);
                    coordinates.push([element['y'], element['x']]);
                    // console.log(typeof element['x']+" "+ element['y']);
                    let group_num = element['title']
                    if(element['alias']!=null){
                        group_num=element['alias'];
                    }
                    var myPoint = new ymaps.Placemark([element['y'], element['x']], {
                        balloonContent: "Группа: " + group_num + "."+element['full_name']+" (" + element['y'] + " " + element['x']+") UID: "+element['id'],
                    }, {
                        iconColor: color + ''
                    });
                    myMap.geoObjects.add(myPoint);
                });


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
    // var myPoint = new ymaps.Placemark([55.694843, 37.435023]);
    // myMap.geoObjects.add(myPoint);
    console.log(data);
    markPlaces(myMap);

        const searchInput = document.getElementById("searchInput");
        const searchResults = document.getElementById("searchResults");

        // Функция для обновления результатов поиска
        function updateSearchResults() {
            const query = searchInput.value.toLowerCase();
            // console.log(typeof data[0]['title']);
            const filteredData = data.filter(item => item.title.toString().includes(query));

            // Очищаем предыдущие результаты
            searchResults.innerHTML = "";

            // Добавляем новые результаты в список
            filteredData.forEach(item => {
                const li = document.createElement("li");
                li.id='adress';
                // li.classList.add("col-4 text-center");
                li.className = "text-center";
                li.textContent = item['title'] +" "+ item['full_name'] +" (" + item['y'] +" "+item['x']+ ")";
                li.addEventListener("click", e => {  
                    searchInput.value = "";
                    searchResults.innerHTML = "";
                    myMap.setCenter([item['y'],item['x']]);
                    myMap.setZoom(18);
                });
                searchResults.appendChild(li);
            });
        }

        // Обработчик события ввода текста
        searchInput.addEventListener("input", updateSearchResults);

}

