<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/animations.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/index.css">
    <title>eDoc</title>
    <style>
        table {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>

</head>

<body>

    <div class="full-height">
        <center>
            <table border="0">
                <tr>
                    <td width="80%">
                        <font class="edoc-logo">eDoc. </font>
                        <font class="edoc-logo-sub">| Easy Regist </font>
                    </td>
                    <td width="10%">
                        <a href="<?= base_url('auth/login'); ?>" class="non-style-link">
                            <p class="nav-item">LOGIN</p>
                        </a>
                    </td>
                    <td width="10%">
                        <a href="<?= base_url('auth/signup'); ?>" class="non-style-link">
                            <p class="nav-item" style="padding-right: 10px;">REGISTER</p>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <p class="heading-text">Hindari kesulitan dan penundaan.</p>

                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p class="sub-text2">Bagaimana kesehatanmu hari ini? Terdengar tidak baik ya!<br> Jangan khawatir. Temukan doktermu secara online dengan eDoc. <br>
Kami menawarkan layanan pemesanan dokter secara gratis, Buat janji temu sekarang juga.</p>
                    </td>
                </tr>
                <tr>

                    <td colspan="3">
                        <center>
                            <a href="<?= base_url('auth/login'); ?>">
                                <input type="button" value="Make Appointment" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            </a>
                        </center>
                    </td>

                </tr>
                <tr>
                    <td colspan="3">

                    </td>
                </tr>
            </table>
            <p class="sub-text2 footer-hashen">A Web Solution by eDoc.</p>
        </center>

    </div>
</body>

</html>