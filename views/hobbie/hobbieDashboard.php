<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <h1>Hobbie Dashboard page!</h1>
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
            foreach ($hobbies as $index => $hobbie) {
                echo "<tr>";
                echo "<td class='tg-0lax'>" . $hobbie["id"] . "</td>";
                echo "<td class='tg-0lax'>" . $hobbie["name"] . "</td>";
                echo "<td class='tg-0lax'>" . $hobbie["type"] . "</td>";
                echo "<td colspan='2' class='tg-0lax'>
                <a class='btn btn-secondary' href='?controller=hobbie&action=getHobbie&id=" . $hobbie["id"] . "'>Edit</a>
                <a class='btn btn-danger' href='?controller=hobbie&action=deleteHobbie&id=" . $hobbie["id"] . "'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a id="home" class="btn btn-primary" href="?controller=hobbie&action=createHobbie">Create</a>
    <a id="home" class="btn btn-secondary" href="./">Back</a>
</body>

</html>