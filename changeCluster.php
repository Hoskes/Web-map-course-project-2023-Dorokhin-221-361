<?php
include 'content/header.php';

if (!isset($_GET['id'])) {
    echo '<h2 class="text-center mt-3">Смена социальной группы объекта</h2>
    <div><h7><pre></pre>  Эта страница необходима для изменения погрешностей измерений программы кластеризации. Для изменения группы объекта нажмите
    кнопку "Изменить группу" и выберите в в форме новую группу для объекта из выпадающего списка.</h7><div>';
    
    echo "<div class='text-center col-12'>
    <div>
        <h3>Введите номер кластера</h3>
    </div>
    <input type='text' id='searchInput' class='mb-2' placeholder='Введите запрос'>
</div>
<div>Найдено записей</div><l id='rows-count'></l>
<table class='table m-auto table-striped table-hover table-bordered border border-success'>
    <thead>
        <tr>
            <th scope='col'>№ Кластера</th>
            <th scope='col'>Полное наименование</th>
            <th scope='col'>Долгота</th>
            <th scope='col'>Широта</th>
            <th scope='col'>Изменить кластер</th>
        </tr>
    </thead>
    <tbody id='searchResults'>
        <script>
            data = [];


            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');

            // Функция для обновления результатов поиска
            function updateSearchResults() {
                const query = searchInput.value.toLowerCase();
                // console.log(typeof data[0]['title']);
                const filteredData = data.filter(item => item.title.toString().toLowerCase().includes(query.toString().toLowerCase()));

                // Очищаем предыдущие результаты
                searchResults.innerHTML = '';
                document.getElementById('rows-count').innerHTML='';
                document.getElementById('rows-count').innerHTML=filteredData.length;
                // Добавляем новые результаты в список
                filteredData.forEach(item => {
                
                    const row = document.createElement('tr');

                    const cell1 = document.createElement('td');
                    cell1.textContent = item['title'];
                    row.appendChild(cell1);

                    const cell2 = document.createElement('td');
                    cell2.textContent = item['full_name'];
                    row.appendChild(cell2);

                    const cell3 = document.createElement('td');
                    cell3.textContent = item['y'];
                    row.appendChild(cell3);

                    const cell4 = document.createElement('td');
                    cell4.textContent = item['x'];
                    row.appendChild(cell4);




                    const cell6 = document.createElement('td');
                    row.appendChild(cell6);


                    const div1 = document.createElement('div');
                            div1.id = 'div-gr-bg';
                            div1.className ='text-center';
                            div1.href = 'changeCluster.php?id=' + item['id'];
                            cell6.appendChild(div1);

                            const link1 = document.createElement('a');
                            link1.id = 'as1';
                            link1.textContent = 'Изменить кластер';
                            link1.href = 'changeCluster.php?id=' + item['id'];
                            div1.appendChild(link1);

                    // const link2 = document.createElement('a');
                    // link2.textContent = 'Показать на карте';
                    // link2.href = 'map.php?id=' + item['id'];
                    // cell7.appendChild(link2);

                    tbody.appendChild(row);

             
            });
            
            }

            // Обработчик события ввода текста
            searchInput.addEventListener('input', updateSearchResults);


            // searchInput.addEventListener('input', updateSearchResults);
            const tbody = document.getElementById('searchResults');
            $.ajax({
                url: 'getMapObjects.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Обновление контейнера
                    if (response.length > 0) {
                        console.log('success');
                        document.getElementById('rows-count').innerHTML=response.length;
                        console.log(response.length);
                        response.forEach(item => {
                            if (item['title'] == null | item['alias'] != null) {
                                item['title'] = item['alias'];
                                // console.log(data);
                            }
                            data.push(item);
                            const row = document.createElement('tr');

                            const cell1 = document.createElement('td');
                            cell1.textContent = item['title'];
                            row.appendChild(cell1);
        
                            const cell2 = document.createElement('td');
                            cell2.textContent = item['full_name'];
                            row.appendChild(cell2);
        
                            const cell3 = document.createElement('td');
                            cell3.textContent = item['y'];
                            row.appendChild(cell3);
        
                            const cell4 = document.createElement('td');
                            cell4.textContent = item['x'];
                            row.appendChild(cell4);
        
        
        
        
                            const cell6 = document.createElement('td');
                            row.appendChild(cell6);
        
                            
        

                            const div1 = document.createElement('div');
                            div1.id = 'div-gr-bg';
                            div1.className ='text-center';
                            div1.href = 'changeCluster.php?id=' + item['id'];
                            cell6.appendChild(div1);

                            const link1 = document.createElement('a');
                            link1.id = 'as1';
                            link1.textContent = 'Изменить кластер';
                            link1.href = 'changeCluster.php?id=' + item['id'];
                            div1.appendChild(link1);
        
                            // const link2 = document.createElement('a');
                            // link2.textContent = 'Показать на карте';
                            // link2.href = 'map.php?id=' + item['id'];
                            // cell7.appendChild(link2);
        
                            tbody.appendChild(row);

                        });


                    } else {
                        console.log('empty');
                    }
                },
                error: function(response) {
                    console.log('error');
                }
            });
        </script>
    </tbody>
</table>
";
} else {
    echo '
    <a id="as" class="col-4 text-center mt-4 " href="changeCluster.php">Вернуться ко всем объектам</a></section>;
    <h2 class="text-center">Изменить кластер записи № ' . $_GET['id'] . '?</h2><div>
    <form action="#" class="text-center mt-4">
    <select id ="select" class="form-select" name="select" >';
    include 'dbConnect.php';
    $query = "SELECT DISTINCT cluster_id,alias FROM results;";
    $result = mysqli_query($mysql, $query);
    //echo mysqli_num_rows($result);
    $connect = '';
    if (mysqli_num_rows($result) > 0) { //Если в БД есть данные об устройстве
        while ($forum = mysqli_fetch_assoc($result)) {
            $alias = '';
            if (!isset($forum['alias'])) {
                $alias = $forum['cluster_id'];
            } else {
                $alias = $forum['alias'];
            }
            $content .= "<option selected value=" . $forum['cluster_id'] . ">" . $alias . "</option>";
        }
        echo $content;
        // include 'try.php';
    } else {
        echo ('ПУСТОЙ ЗАПРОС ВОЗМОЖНО ОШИБКА');
    }
    echo '</select><input id="btn-sumbit" class="btn col-12 btn-sucsess text-center mt-4" value="Сохранить"></form>';
}


include 'content/footer.php';


?>
<div id="otvet"></div>
<script>
    var select = document.getElementById('select');
    var input = document.getElementById('input');
    $('#btn-sumbit').click(function() {
        $.ajax({
            url: 'sendNewClusterNum.php?id=<?php echo $_GET['id'] ?>'+"&cluster_id="+document.getElementById('select').options[select.selectedIndex].value,
            method: 'get',
            async: false, // Установите async в false для синхронного запроса
            success: function(data) {
                // Обработка ответа от сервера
                console.log(data);
                window.location.replace('changeCluster.php');
            }
        });
    });
</script>