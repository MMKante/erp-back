<div class="row">
	<div class="col-lg-4 col-6">
		<div class="small-box bg-info">
			<div class="inner">
				<h3><?= $data['ProductionInProgress'] ?></h3>
				<p>Незавершенные производства</p>
			</div>
			<div class="icon">
				<i class="ion ion-bag"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-6">
		<div class="small-box bg-success">
			<div class="inner">
				<h3><?= $data['ProductionCompleted'] ?></h3>
				<p>Завершенные производства</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-6">
		<div class="small-box bg-danger">
			<div class="inner">
				<h3><?= $data['ProductionAborted'] ?></h3>
				<p>Отмененные производства</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
		</div>
	</div>
</div>