<?php
session_start();
if (isset($_SESSION['id'])) {
    $existe = 1;
} else {
    $existe = 0;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <title>BikeStation</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script>
            function listar(str) {
                $("#ciudad").load("run.php?q=" + str);
            }
            $(document).ready(function () {

                var flag = <?php echo $existe; ?>;
                if (flag) {
                    $('#tiempo').load("weather.php"),
                    $('#example').dataTable({
                        "ajax": {
                            "url": "ajax.php",
                            "type": "POST"
                        },
                        "columns": [
                            {"data": "name"},
                            {"data": "slots"},
                            {"data": "free_bikes"},
                            {"data": "empty_slots"}
                        ]
                    });
                } else {
                    $('#contenido').hide();
                }
            });</script>
    </head>
    <body>
        <div id='formulario'>
            <h2>BikeStation</h2>
            <form action="run.php" method="POST">
                <fieldset>
                    <legend>Busqueda</legend>
                    Pais:<select name="pais" id="pais" onclick="listar(this.value)">

                        <option value="ES">España</option>
                        <option value="FR">Francia</option>
                        <option value="IT">Italia</option>
                        <option value="PL">Polonia</option>
                    </select>
                    <br>
                    Ciudad:<select name="ciudad" id="ciudad">
                        <option>
                            Elija primero un pais
                        </option>
                    </select>
                    <br><br>
                    <input type="submit" name="enviar" value="Buscar">
                </fieldset>
            </form>  
            <p>Servicio: <?php echo $_SESSION['id']; ?></p>
            <div id="tiempo">
                
            </div>
        </div>
        <div id='contenido'>
            <table id="example" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Estación</th>
                        <th>Bornetas Totales</th>
                        <th>Bicis Disponibles</th>
                        <th>Bornetas Disponibles</th>
                    </tr>
                </thead>
            </table>
        </div>
    </body>


</html>
