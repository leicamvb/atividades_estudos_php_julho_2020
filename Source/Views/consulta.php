<form class="w-100 p-3">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button id="btnProcurar" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Procurar por</button>
            <div id="dropdown-menu" class="dropdown-menu">
                <a class="dropdown-item" href="#">Cliente Id</a>
                <a class="dropdown-item" href="#">Cliente Nome</a>
                <a class="dropdown-item" href="#">Produto Cod</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Pedido Num</a>
            </div>
        </div>
        <input id="txtProcurar" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Pesquisar">
        <button type="button" class="btn btn-primary" onclick="consultar(document.getElementById('btnProcurar').innerText, document.getElementById('txtProcurar').value)">Procurar</button>
    </div>
</form>

<div id="txtHint"><b>Resultado da pesquisa...</b></div>

<script>
    function consultar(tipo, termo) {
        if (tipo == "Procurar por" || termo == "") {
            document.getElementById("txtHint").innerHTML = "Informe o que deseja localizar";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };

            xmlhttp.open("POST", "Source/Views/ajaxConsulta.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("tipo=" + tipo + "&termo=" + termo);
        }
    }

    document.querySelectorAll('a').forEach(function(el) {
        el.addEventListener('click', function() {
            document.querySelector('.dropdown-toggle').innerText = el.textContent;
        });
    });
</script>