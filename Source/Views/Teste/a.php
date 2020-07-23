<form action="/Source/Models/b.php" method="get" id="registerSubmit">
    <input type="text" name="name" id="name" placeholder="Name">
    <button id="submit" type="submit">Submit</button>
</form>

<div id="result"></div>

<script>
    $(document).ready(function() {
        $("#registerSubmit").submit(function(e) {
            $url = "/Source/Models/b.php"
            e.preventDefault();
            $.ajax({
                url: $url,
                dataType: 'json',
                method: "get",
                data: $(this).serialize(),
                crossDomain: true,
                cache: true,
                dataType: "text",
                success: function(Result) {
                    $('#result').html(Result)
                }

            }).done(function(resp) {
                //'do something when ok'
            }).fail(function(err) {
                // 'do something when something is wrong'
            }).always(function() {
                // 'do  something whether request is ok or fail'
            });

        });
    });
</script>