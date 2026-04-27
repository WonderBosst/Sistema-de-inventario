<?php
include '../includes/conexion.php';
include '../includes/auth.php';
include '../includes/header.php';
requireRole(['1']);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-bar-chart fs-1 text-danger"></i> Estad&iacute;sticas
      <i class="bi bi-question-circle text-primary" 
        style="cursor: pointer; margin-left: 5px;" 
        data-bs-toggle="tooltip" 
        data-bs-placement="top" 
        title="En esté apartado podra ver por mes y año cuales fueron los trabajadores más participativos, los productos más usados, los materiales más usados y las operaciones realizadas">
      </i>
    </h3>
</div>

<div class="card shadow rounded-4">
  <div class="card-body">
    <div class="row g-3"> 
      <div class="col-md-3">
        <label class="form-label">Mes</label>
        <select name="mes" id="filter_mes" class="form-select">
            <?php
            $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            foreach ($meses as $i => $m) {
                $sel = ($i+1 == date('n')) ? 'selected' : '';
                echo "<option value='".($i+1)."' $sel>$m</option>";
            }
            ?>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Año</label>
        <select name="anio" id="filter_anio" class="form-select">
            <?php
            $anio_actual = date('Y');
            for ($i = $anio_actual; $i >= $anio_actual - 10; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Estadística</label>
        <select name="estadistica" id="filter_tipo" class="form-select">
          <option value="1">Trabajadores</option>
          <option value="2">Productos</option>
          <option value="3">Materiales</option>
          <option value="4">Operaciones</option>
        </select>
      </div>
    </div> 
  </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow rounded-4 p-3">
            <div style="height: 400px;"> 
                <canvas id="graficaEstadisticas"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>