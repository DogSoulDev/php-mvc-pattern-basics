<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/script.js" type="module"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Jobs In</title>
</head>

<body>
    <div class="container">
        <h1>Job Index</h1>
        </br>

        
        <?php
        if ($action == "getJob" && (!isset($job) || !$job || sizeof($job) == 0)) {
            echo "<p>The Job does not exists!</p>";
        } else if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>


        <form class="mb-5 needs-validation" action="?controller=job&action=<?php echo isset($job['id']) ? "updateJob" : "createJob" ?>" method="post">
            <input type="hidden" name="id" value="<?php echo isset($job['id']) ? $job['id'] : null ?>">
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input required type="text" value="<?php echo isset($job['name']) ? $job['name'] : null ?>" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control" id="type" required>
                            <option value="">Please Select</option>
                            <option value="Indoor" <?php echo isset($job['type']) && $job['type']  == "Indoor" ? 'selected' : null; ?>>Indoor</option>
                            <option value="Outdoor" <?php echo isset($job['type']) && $job['type']  == "Outdoor" ? 'selected' : null; ?>>Outdoor</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a id="return" class="btn btn-secondary" href="<?php echo "?controller=job&action=getAllJobs&action=getAllJob"; ?>">Return</a>
        </form>
    </div>
</body>

</html>