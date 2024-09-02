<?php
$id_transaksi = $_GET['id'];

$transaksi = Transaksi::makeObjek($pdo);
$rows = $transaksi->getDetailTransaksi($id_transaksi);

if (isset($id_transaksi)) {
    extract($transaksi->getForStruk($id_transaksi));
}


?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="card-body">
                <h3 class="card-title">Struk Transaksi</h3>
                <div class="text-right">
                    <h4><?= $tanggal ?></h4>
                </div>
                <div class="col">
                    <p>ID transaksi : <?= $id_transaksi ?> </p>
                    <p>ID Pembayaran : <?= $id_bayar ?> </p>
                    <p>ID Pembayaran : <?= $inv ?> </p>
                </div>
                <hr>
                <div class="tabel-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th class="align-middle" scope="col">Nama Product</th>
                                <th class="align-middle" scope="col">Jumlah</th>
                                <th class="align-middle" scope="col">Harga Satuan</th>
                                <th class="align-middle" scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($rows as $row) {
                            ?>
                                <tr>
                                    <td class="align-middle"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($row['qty']) ?></td>
                                    <td class="align-middle">Rp. <?= htmlspecialchars(number_format($row['harga'])) ?></td>
                                    <td class="align-middle">Rp. <?= htmlspecialchars(number_format($row['qty'] * $row['harga'])) ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table table-striped table-md">
                        <tbody class="text-center">
                            <tr>
                                <th>Total Harga</th>
                                <th>Jumlah Yang Dibayarkan</th>
                                <th>Kembalian</td>
                            </tr>
                        </tbody>
                        <tbody class="text-center">
                            <tr>
                                <td class="align-middle col-md-3">Rp. <?= htmlspecialchars(number_format($total)) ?></td>
                                <td class="align-middle col-md-3">Rp. <?= htmlspecialchars(number_format($dibayar)) ?></td>
                                <td class="align-middle col-md-3">Rp. <?= htmlspecialchars(number_format($kembali)) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-lg btn-block btn-cetak" data-id="<?= $id_transaksi ?>">Cetak</button>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.querySelectorAll('.btn-cetak').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const idTransaksi = this.getAttribute('data-id');

            Swal.fire({
                title: 'Apakah Anda Ingin Mencetak Struk?',
                text: "Dengan Menyetak Struk Berarti Transaksi Sudah Dianggap Selesai",
                textColor: 'white',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya , Ceta',
                cancelButtonText: 'Tida, Jangan Cetak',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `index.php?report=report&act=struks&id=${idTransaksi}`;
                }
            });
        });
    });
</script>