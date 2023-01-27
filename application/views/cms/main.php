<div class="container">

	<div class="card mt-5">
	  <div class="card-body shadow">
	  	<div class="mb-3">
		  	<button class="btn btn-sm btn-success" href="#" role="button" data-toggle="modal" data-target="#importData"><i class="fa fa-upload"></i> Import Data</button>
		  	<a class="btn btn-sm btn-success" href="<?= base_url('Dashboard/downloadData') ?>" role="button"><i class="fa fa-download"></i> Download Data</a>
	  	</div>
		<table id="table_id">
			<thead>
				<tr>
					<th>BS_DATE</th>
					<th>BROKER</th>
					<th>SAHAM</th>
					<th>B_VAL</th>
					<th>B_LOT</th>
					<th>B_FREQ</th>
					<th>B_AVG</th>
					<th>S_VAL</th>
					<th>S_LOT</th>
					<th>S_FREQ</th>
					<th>S_AVG</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data_main->result() as $value_main): ?>
				<tr>
					<td><?= $value_main->BS_DATE ?></td>
					<td><?= $value_main->BROKER ?></td>
					<td><?= $value_main->SAHAM ?></td>
					<td><?= $value_main->B_VAL ?></td>
					<td><?= $value_main->B_LOT ?></td>
					<td><?= $value_main->B_FREQ ?></td>
					<td><?= $value_main->B_AVG ?></td>
					<td><?= $value_main->S_VAL ?></td>
					<td><?= $value_main->S_LOT ?></td>
					<td><?= $value_main->S_FREQ ?></td>
					<td><?= $value_main->S_AVG ?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
			
		</table>
	  </div>
	</div>

  	<div class="modal fade" id="importData" tabindex="-1">
  		<div class="modal-dialog">
  			<div class="modal-content">
  				<div class="modal-header">
  					<h5 class="modal-title">Import Data</h5>
  					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  						<span aria-hidden="true">&times;</span>
  					</button>
  				</div>
  				<form method="POST" enctype="multipart/form-data" action="<?= base_url('Dashboard/importData') ?>">
  					<div class="modal-body">
  						<div class="input-group mt-3 mb-3">
  							<div class="custom-file">
  								<input type="file" name="fileImport" required>
  							</div> 
  						</div>
  						<small class="bg bg-warning font-weight-bold"><i>*Max Size 1MB</i></small>  
  					</div>

  					<div class="modal-footer">
  						<button type="submit" class="btn btn-primary btn-sm">Import</button>
  						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
  					</div>
  				</form>
  			</div>
  		</div>
  	</div>

</div>


<script>
	
	$(document).ready( function () {
	    $('#table_id').DataTable();
	} );

</script>