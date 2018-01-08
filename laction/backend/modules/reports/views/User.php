<div class="main-content">

	<div class="card">
		<h4 class="card-title">
			<strong>Samples</strong>
		</h4>

		<form data-provide="validation" data-disable="false" novalidate="true">
			<div class="card-body">

				<div class="form-group row">
					<label class="col-4 col-lg-2 col-form-label require" for="input-1">Role</label>
					<div class="col-8 col-lg-10">
						<select class="form-control" placeholder="Select role" id="select">
							<option>--Select option--</option>
							<option>Admin</option>
							<option>Super Admin</option>

						</select>
						<div class="invalid-feedback"></div>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-4 col-lg-2 col-form-label require" for="input-1">Fullname</label>
					<div class="col-8 col-lg-10">
						<input type="text" class="form-control" id="input-1" required="">
						<div class="invalid-feedback"></div>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-4 col-lg-2 col-form-label" for="input-2">Phone</label>
					<div class="col-8 col-lg-10">
						<input type="text" class="form-control" id="input-2"
							placeholder="Minimum 6 character" data-minlength="6"
							data-error="Minimum length is 6 character.">
						<div class="invalid-feedback"></div>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-4 col-lg-2 col-form-label" for="input-3">Email</label>
					<div class="col-8 col-lg-10">
						<input type="text" class="form-control" id="input-3"
							placeholder="Maximum 6 character" maxlength="6">
						<div class="invalid-feedback"></div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-4 col-lg-2 col-form-label" for="input-3">Photo</label>
					<div class="col-8 col-lg-10">
						<input type='file' onchange="readURL(this);" />

						<div class="invalid-feedback"></div>
					</div>
				</div>


			</div>

		</form>
	</div>

</div>
