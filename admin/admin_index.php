<?php
session_start();
require_once '../models/MySQL.php';
$mysql = new MySQL;
$mysql->conectar();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Panel</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Usuarios Registrados</h3>
                    </div>
                    <div class="col-md-4">
                        <h3>h3. Lorem ipsum dolor sit amet.</h3>
                    </div>
                    <div class="col-md-4">
                        <h3>h3. Lorem ipsum dolor sit amet.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">

                        <button type="button" class="btn btn-success btn-block">
                            <a href="./admin_dashboard.php">Lista</a>
                        </button>
                    </div>
                    <div class="col-md-4">

                        <button type="button" class="btn btn-success btn-block">
                            Button
                        </button>
                    </div>
                    <div class="col-md-4">

                        <button type="button" class="btn btn-success btn-block">
                            Button
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>



</html>