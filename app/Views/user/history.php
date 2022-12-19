<style>
    #container td {
        vertical-align: middle;
    }
</style>

<div id="container" class="container text-center border border-dark rounded">
    <h2 class="font-weight-bold my-4"><i class="fa fa-history"></i> History</h2>
    <?php if (!empty($history) && is_array($history)) : ?>
        <?php $no = 1; ?>
        <div class="table-responsive">        
            <table class="table table-hover">
                <thead style="white-space: nowrap;">
                    <tr>
                        <th>No</th>                         
                        <th><i class="fa fa-id-card-o"></i> Nama Quis</th>
                        <th><i class="fa fa-level-up"></i> Level</th>
                        <th><i class="fa fa-calendar"></i> Tanggal</th>
                        <th><i class="fa fa-clock-o"></i> Jam</th>
                        <th><i class="fa fa-star"></i> Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $history_item): ?>
                        <?php $tanggal = date_create($history_item->tanggal) ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td class="text-capitalize"><?= esc($history_item->nama_quis); ?></td>
                            <td><?= esc($history_item->level); ?></td>
                            <td><?= esc(date_format($tanggal, 'd/m/Y')); ?></td>
                            <td><?= esc(date_format($tanggal, 'H:i')); ?></td>
                            <td><?= esc($history_item->hasil); ?></td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>

        <h4 class="text-center text-danger font-weight-bold my-5">Tidak ada history ditemukan</h4>

    <?php endif ?>
</div>