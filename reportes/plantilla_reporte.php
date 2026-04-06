<div class="row g-4 mt-3 text-center">

<div class="col-md-3">
<div class="card shadow p-4 bg-success text-white">
<h6>Ventas</h6>
<h3>$<?= number_format($data['ventas'],2) ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card shadow p-4 bg-danger text-white">
<h6>Costo Produccion</h6>
<h3>$<?= number_format($data['produccion'],2) ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card shadow p-4 bg-primary text-white">
<h6>Utilidad</h6>
<h3>$<?= number_format($data['utilidad'],2) ?></h3>
</div>
</div>

<div class="col-md-3">
<div class="card shadow p-4 bg-warning text-dark">
<h6>Piezas Vendidas</h6>
<h3><?= $data['piezas_vendidas'] ?></h3>
</div>
</div>

</div>