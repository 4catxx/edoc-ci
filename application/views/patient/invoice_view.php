<style>
    .invoice {
        font-family: Arial, sans-serif;
        width: 80%;
        margin: 0 auto;
    }
    .invoice-header {
        background-color: #f2f2f2;
        padding: 10px;
        text-align: center;
    }
    .invoice-details {
        margin-top: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>
<div class="invoice">
<div class="invoice-details">
    <?php if ($schedule !== null): ?>
    <div class="h3-search">
        Nama Dokter:  &nbsp;&nbsp;<b><?= $schedule['docname'] ?></b><br>
        Email Dokter:  &nbsp;&nbsp;<b><?= $schedule['docemail'] ?></b> 
    </div>
    <div class="h3-search">
        Tittle: <?= $schedule['title'] ?><br>
        Tanggal Konsultasi: <?= $schedule['scheduledate'] ?><br>
        Mulai Konsultasi : <?= $schedule['scheduletime'] ?><br>
        Biaya Dokter : <b>RP.<?= number_format($schedule['channelingFee'], 2) ?></b>
    </div>
    <?php endif; ?>
</div>