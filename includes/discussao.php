<!-- SECTION 4 - COMENTARIOS SECTION -->
<section id="discussao" class="pt-1 pb-5" data-anime="left">
    <div class="container mt-4">
        <h1 class='text-center'>Deixe o seu comentário</h1>
        <form id="comment_form" class="my-4">
            <div class="form-group">
                <input id="comment_name" name="comment_name" type="text" class="form-control" placeholder="Digite seu nome" autocomplete="off" style="background-color: #F0F1F4; color: #440E0B;">
            </div>
            <div class="form-group my-3">
                <textarea name="comment_content" id="comment_content" class="form-control form-control-lg" placeholder="Participe da discussão" rows="3" maxlength="600" style="background-color: #F0F1F4; color: #440E0B; resize: none;"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Publicar Comentario" />
            </div>
            <!-- <button id="btn-comment" class="btn btn-lg mt-4 fw-bold" type="submit">Publicar Comentario</button> -->
        </form>

        <span id="comment_message"></span>
        <br />
        <div id="display_comment"></div>
    </div>
</section>

<!-- <script src="https://malsup.github.io/jquery.form.js"></script> -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->

<script>
    $(document).ready(function() {

        $('#comment_form').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "includes/add_comment.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function(data) {
                    if (data.error != '') {
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data.error);
                        $('#comment_id').val('0');
                        load_comment();
                    }
                }
            })
        });

        load_comment();

        function load_comment() {
            $.ajax({
                url: "includes/fetch_comment.php",
                method: "POST",
                success: function(data) {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function() {
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_name').focus();
        });

    });
</script>