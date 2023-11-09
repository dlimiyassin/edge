<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="style.css">
</head>

<body style="margin: 40px;">
    <nav>
        <form action="index.html" method="get">
            <button class="btn btn-info mb-2">Ajouter un status</button>
        </form>
    </nav>
    <h1>heelo sir</h1>
    <div>
    <canvas id="myChart"></canvas>
    </div>
    <?php
    // connexion à la base de données 
    $maConnexion= mysqli_connect("localhost","root","","edge1");
    if(!$maConnexion){
        echo "connexion échouée";
    }
    
    $req = mysqli_query($maConnexion,"SELECT nom,rendement FROM employees");

    foreach($req as $data){
        $tech[]=$data['nom'];
        $rendement[]=$data['rendement'];
    }
    ?>

    <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
    type: 'line',
    data: {
    labels: <?php echo json_encode($tech) ?>,
    datasets: [{
        label: 'Rendement des techniciens',
        data: <?php echo json_encode($rendement) ?>,
        borderWidth: 1
    }]
    },
    options: {
    scales: {
        y: {
        beginAtZero: true
        }
    }
    }
});
</script>

</body>
</html>