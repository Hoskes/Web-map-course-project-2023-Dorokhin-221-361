<?php include 'content/header.php' ?>

<div class='container text-center'>
    ЭТО СТРАНИЦА С КАРТОЙ

    
    <div id="map" class="text-center col-12 m-auto" style="width: 600px; height: 400px"></div>
    <h1>Живой поиск</h1>
    <input type="text" id="searchInput" placeholder="Введите запрос">
    <ul id="searchResults"></ul>

    <script>
  
    </script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=92751a28-cfe2-4f95-b44f-b82f431a2b43&lang=ru_RU" type="text/javascript"></script>
    <script src="index.js" type="text/javascript"></script>
	<style>
        body, html {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100%;
        }
        #map {
            width: 100%;
            height: 90%;
        }
    </style>
    
</div>
<?php include 'content/footer.php' ?>