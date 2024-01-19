<?php
// include 'Web-map-project/dbConnect.php';
//  include 'Web-map-project/content/header.php';
// $forum_id = $_GET['forum_id'];
// include 'Web-map-project/forum-page.php?id=1';
?>

<div id='try-req' class='col-md-12 text-center p-3'></div>

<script>
    $(document).ready(function() {
        
        function reloadPartial() {
            
            $.ajax({
                url: 'part-text.php?f_id=<?php echo $forum_id?>',
                type: 'POST',
                success: function(response) {
                    // Обновление контейнера
                    if(response!=''){
                    $('#try-req').html(response);
                    }
                }
            });
        }

       
        reloadPartial();
        console.log('SUCC');
        
        setInterval(reloadPartial, 3000);
    });
    window.onload = function() {
        window.scrollTo(0, document.body.scrollHeight);
    }
</script>
<script>
    $(function() {
        $('form').submit(function() {
            var form = $(this);
            $.ajax({
                type: "POST",
                url: "sendMessage.php?forum_id=<?php echo $forum_id?>",
                data: form.serialize(),
                beforeSend: (function() {
                    $('.submit').css('color', 'transparent');
                    $('.submit').addClass('progress-bar progress-bar-striped progress-bar-animated bg-warning');
                    
                }),
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('.error-data').slideDown();
                },
                success: (function() {
                    $('.submit').css('color', '#333');
                    $('.submit').removeClass('progress-bar progress-bar-striped progress-bar-animated bg-warning');
                    $('.alrt').fadeIn();
                    setTimeout(function() {
                        form.trigger("reset");
                    }, 2000);
                })
            })
            return false;
        })
    })
</script>
<?php 
if(isset($_SESSION['auth'])){
    echo "<div class='container mt-2 mb-2 col-12'>
    <form class='row text-center' method='post'>
        <div class='col-md-10 col-sm-10 ms-0'>
            <textarea class='form-control' name='comment' placeholder='Введите сообщение сообщение...'></textarea>

        </div>
        <div class='col-md-2 col-sm-2  m-auto ms-0'>
            <input id='btn-sumbit' class='btn btn-sucsess' type='submit' class='button' value='Отправить текст'>
        </div>
    </form>
</div>
";
}
?>