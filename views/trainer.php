<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">Sélection</div>
	<div class="panel-body">
		<?php include 'alerts.php'; ?>
		<form action="" method="get">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php $selectTrainer->displayHTML(); ?>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<input type="submit" class="btn btn-success btn-block" value="Sélectionner" />
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<a href="?" class="btn btn-info btn-block">Ajouter</a>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-primary">
	<!-- Default panel contents -->

	<div class="panel-body">
		<form action="" method="post">
			<input type="hidden" name="id" value="<?= $studentObject->getId() ?>">
			<div class="row">

				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="trn_lastname">Trainer</label>
						<input type="text" class="form-control" name="trn_lastname" id="trn_lastname" placeholder="Lname" value="<?= $studentObject->getLocation() ?>">
					</div>
				</div>
        <div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="trn_firstname">Trainer</label>
						<input type="text" class="form-control" name="trn_firstname" id="trn_firstname" placeholder="Fname" value="<?= $studentObject->getLocation() ?>">
					</div>
				</div>

			<div class="row">
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input type="submit" class="btn btn-success btn-block" value="Valider" />
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<a href="?delete=<?= $studentObject->getId() ?>" class="btn btn-warning btn-block<?php if ($studentObject->getId() <= 0) : ?> disabled<?php endif; ?>" role="button" aria-disabled="true">Supprimer</a>
				</div>
			</div>
		</form>
	</div>
</div>
