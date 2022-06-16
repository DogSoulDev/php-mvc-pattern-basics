<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/normalize.css.css">
    <script src="../../assets/js/script.js" type="module"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Employee In</title>
</head>

<body>
    <div class="containter">
        <h1>Employee Index</h1>
        </br>

        <?php
        if ($action == "getEmployee" && (!isset($employee) || !$employee || sizeof($employee) == 0)) {
            echo "<p>The employee does not exists!</p>";
        } else if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>
        <form class="mb-5 needs-validation"
            action="index.php?controller=employee&action=<?php echo isset($employee['id']) ? "updateEmployee" : "createEmployee" ?>"
            method="post">
            <input type="hidden" name="id" value="<?php echo isset($employee['id']) ? $employee['id'] : null ?>">
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input required type="text"
                            value="<?php echo isset($employee['name']) ? $employee['name'] : null ?>"
                            class="form-control" id="name" name="name" aria-describedby="name" placeholder="Enter name">
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input required type="text"
                            value="<?php echo isset($employee['last_name']) ? $employee['last_name'] : null ?>"
                            class="form-control" id="lastName" name="last_name" aria-describedby="lastnameHelp"
                            placeholder="Enter last name">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input required type="email"
                            value="<?php echo isset($employee['email']) ? $employee['email'] : null ?>"
                            class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender_id" class="form-control" id="gender" required>
                            <option value="">Please Select</option>
                            <option value="1"
                                <?php echo isset($employee['gender_id']) && $employee['gender_id']  == 1 ? 'selected' : null; ?>>
                                Male</option>
                            <option value="2"
                                <?php echo isset($employee['gender_id']) && $employee['gender_id']  == 2 ? 'selected' : null; ?>>
                                Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" value="<?php echo isset($employee['city']) ? $employee['city'] : null ?>"
                            class="form-control" id="city" name="city" aria-describedby="CityHelp"
                            placeholder="Enter City">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="streetAddress">Street Address</label>
                        <input type="text"
                            value="<?php echo isset($employee['street_address']) ? $employee['street_address'] : null ?>"
                            class="form-control" id="streetAddress" name="street_address"
                            aria-describedby="streetAddressHelp" placeholder="Enter streetAddress">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" value="<?php echo isset($employee['state']) ? $employee['state'] : null ?>"
                            class="form-control" id="state" name="state" aria-describedby="stateHelp"
                            placeholder="Enter state">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" value="<?php echo isset($employee['age']) ? $employee['age'] : null ?>"
                            class="form-control" id="age" name="age" aria-describedby="ageHelp" placeholder="Enter age">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="postalCode">Postal Code</label>
                        <input type="text"
                            value="<?php echo isset($employee['postal_code']) ? $employee['postal_code'] : null ?>"
                            class="form-control" id="postalCode" name="postal_code" aria-describedby="postalCodeHelp"
                            placeholder="Enter postalCode">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="phoneNumber">PhoneNumber</label>
                        <input type="text"
                            value="<?php echo isset($employee['phone_number']) ? $employee['phone_number'] : null ?>"
                            class="form-control" id="phoneNumber" name="phone_number" aria-describedby="phoneNumberHelp"
                            placeholder="Enter phoneNumber">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a id="return" class="btn btn-secondary"
                href="<?php echo "?controller=employee&action=getAllEmployees&action=getAllEmployees"; ?>">Return</a>
        </form>
    </div>
</body>

</html>