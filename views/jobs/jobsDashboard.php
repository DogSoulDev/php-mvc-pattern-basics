<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/normalize.css.css">
    <script src="../../assets/js/script.js" type="module"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Jobs Dash</title>
</head>

<body>
    <h1>Jobs Dashboard</h1>
    <style type="text/css">

    </style>
    <table class="table">
        <thead>
            <tr>
                <th class="tg-0pky">ID</th>
                <th class="tg-0pky">Name</th>
                <th class="tg-0lax">Type</th>
                <th class="tg-0lax">Action</th>

            </tr>
        </thead>
        <tbody>
            
            <?php
            foreach ($jobs as $index => $job) {
                echo "<tr>";
                echo "<td class='tg-0lax'>" . $job["id"] . "</td>";
                echo "<td class='tg-0lax'>" . $job["name"] . "</td>";
                echo "<td class='tg-0lax'>" . $job["type"] . "</td>";
                echo "<td colspan='2' class='tg-0lax'>
                <a class='btn btn-secondary' href='?controller=jobs&action=getJob&id=" . $job["id"] . "'>Edit</a>
                <a class='btn btn-danger' href='?controller=jobs&action=deleteJob&id=" . $job["id"] . "'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a id="home" class="btn btn-primary" href="?controller=jobs&action=createJob">Create</a>
    <a id="home" class="btn btn-secondary" href="./">Back</a>
</body>

</html>