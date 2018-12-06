<?php include_once(dirname(__FILE__).'/header.php'); ?>
<h1 class="page-header">Painel</h1>

<div class="panel panel-primary">
    <div class="panel-heading">Crescimento</div>
	<div class="panel-body" style="height=50px;">
		<canvas id="myChart"></canvas>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
		labels: <?php echo json_encode(array_keys($empresas), true) ?>,
        datasets: [{
            label: "Empresas",
            backgroundColor: 'rgb(51, 122, 183)',
            borderColor: 'rgb(22, 101, 168)',
			data: <?php echo json_encode(array_values($empresas), true) ?>,
        }]
    }
});
chart.canvas.parentNode.style.height = '100px';
</script>
<?php include_once(dirname(__FILE__).'/footer.php'); ?>
