<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/normalize.css">
    <link rel="stylesheet" href="../../assets/css/style.css.css">
    <script src="../../assets/js/script.js" type="module"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Hobbie Index</title>
    
</head>

<body>
    <div class="container">
        <h1>Hobbie Manager</h1>
        </br>

        <?php
        if ($action == "getHobbie" && (!isset($hobbie) || !$hobbie || sizeof($hobbie) == 0)) {
            echo "<p>The hobbie does not exists!</p>";
        } else if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>
        <form class="mb-5 needs-validation"
            action="?controller=hobbie&action=<?php echo isset($hobbie['id']) ? "updateHobbie" : "createHobbie" ?>"
            method="post">
            <input type="hidden" name="id" value="<?php echo isset($hobbie['id']) ? $hobbie['id'] : null ?>">
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input required type="text"
                            value="<?php echo isset($hobbie['name']) ? $hobbie['name'] : null ?>" class="form-control"
                            id="name" name="name" aria-describedby="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" id="type" required>
                            <option value="">Please Select</option>
                            <option value="Indoor"
                                <?php echo isset($hobbie['type']) && $hobbie['type']  == "Indoor" ? 'selected' : null; ?>>
                                Indoor</option>
                            <option value="Outdoor"
                                <?php echo isset($hobbie['type']) && $hobbie['type']  == "Outdoor" ? 'selected' : null; ?>>
                                Outdoor</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a id="return" class="btn btn-secondary"
                        href="<?php echo "?controller=hobbie&action=getAllHobbies&action=getAllHobbies"; ?>">Return</a>
        </form>
    </div>
</body>

</html>