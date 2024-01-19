<?php
include 'content/header.php';
echo '<h1 class="text-center mt-3">Задать кластеру псевдоним</h1>';
 if (!isset($_GET['cluster_id'])) {

    echo '<h2 class="text-center">Изменить кластеры</h2><div>';
    include 'dbConnect.php';
    $query = "SELECT DISTINCT cluster_id,alias FROM results;";
    $result = mysqli_query($mysql, $query);
    //echo mysqli_num_rows($result);
    $connect = '';
    echo "<table class='table m-auto table-striped table-hover table-bordered border border-success'><thead>
    <tr>
        <th scope='col'>№ группы</th>
        <th scope='col'>Псевдоним</th>
        <th scope='col'>Изменить значение</th>
    </tr>
</thead><tbody>";

    if (mysqli_num_rows($result) > 0) { //Если в БД есть данные об устройстве
        while ($forum = mysqli_fetch_assoc($result)) {
            $alias = '';
            $cluster = '';
            echo '<tr>';
            if (isset($forum['alias'])) {
                $alias = $forum['alias'];
            }
            if (isset($forum['cluster_id'])) {
                $cluster = $forum['cluster_id'];
            }
            echo "<td>" . $cluster . "</td><td>" . $alias . "</td><td><div id='div-gr-bg' class='text-center'><a id='as' class='text-center' href='ClustersData.php?cluster_id=".$cluster."'>Изменить группу ".$cluster."</a></div></td>";
            echo '</tr>';
            
        }
        // include 'try.php';
    } else {
        echo ('ПУСТОЙ ЗАПРОС ВОЗМОЖНО ОШИБКА');
    }
    echo "</tbody></table>";

    
}else{

  echo '<form action="#" class="text-center mt-4"><input id="input" class="col-12" type="sumbit" placeholder="Введите псевдоним...">';
  echo '<input id="btn-sumbit" class="btn col-12 btn-sucsess text-center mt-4" value="Сохранить"></form>';
  

}
include 'content/footer.php';
?>
<div id="otvet"></div>
<script>
    
  var select = document.getElementById('select');
  var input = document.getElementById('input');
  $('#btn-sumbit').click(function() {
      $.ajax({
          url: "markCluster.php?id=<?php echo $_GET['cluster_id']?>&cluster_id="+document.getElementById('input').value,
          method: 'get',
          async: true, 
          success: function(data) {
              
              console.log(data);
              window.location.replace('ClustersData.php');
          },
          error: function(data) {
              
              console.log(data);
              
          }
      });
  });
</script>