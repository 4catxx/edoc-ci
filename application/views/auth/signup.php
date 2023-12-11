<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/animations.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/login.css">

    <title>Sign Up</title>

</head>

<body>
    <?php


    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the new timezone
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d');

    $_SESSION["date"] = $date;



    if ($_POST) {



        $_SESSION["personal"] = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'address' => $_POST['address'],
            'nic' => $_POST['nic'],
            'dob' => $_POST['dob']
        );


        print_r($_SESSION["personal"]);
        header("location: create_account");
    }

    ?>


    <center>
        <div class="container">
            <table border="0">
                <tr>
                    <td colspan="2">
                        <p class="header-text">Let's Get Started</p>
                        <p class="sub-text">Add Your Personal Details to Continue</p>
                    </td>
                </tr>
                <tr>
                    <form action="" method="POST">
                        <td class="label-td" colspan="2">
                            <label for="name" class="form-label">Nama: </label>
                        </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="text" name="name" class="input-text" placeholder="Nama" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="address" class="form-label">Alamat: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="text" name="address" class="input-text" placeholder="Alamat" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="nic" class="form-label">NIK: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="text" name="nic" class="input-text" placeholder="NIK" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="dob" class="form-label">Tanggal Lahir: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="date" name="dob" class="input-text" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                    </td>
                    <td>
                        <input type="submit" value="Next" class="login-btn btn-primary btn">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="<?= base_url('auth/login'); ?>" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>

                </form>
                </tr>
            </table>

        </div>
    </center>
</body>

</html>