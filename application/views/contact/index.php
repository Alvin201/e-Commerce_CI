<div id="fh5co-contact">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-1 animate-box">
					
					<div class="fh5co-contact-info">
						<h3>Kontak Informasi</h3>
						<?php
	                    foreach ($model as $key => $value) {
	                    ?>
						<ul>
							<li class="address"><?php echo $value->address;?></li>
							<li class="phone"><?php echo $value->phone_number;?></li>
							<li class="email"><?php echo $value->email;?></li>
							<li class="url"><a href="http://www.anone.id">Anone Indonesia Group</a></li>
						</ul>
						<?php
	                    }
	                    ?>
					</div>

				</div>
				<div class="col-md-6 animate-box">
					<h3>Hubungi Kami</h3>
					<form action="<?php echo base_url('dashboard/savemessage');?>" method="POST">
						<div class="row form-group">
							<div class="col-md-6">
								<!-- <label for="fname">First Name</label> -->
								<input type="text" name="fname" id="fname" class="form-control" placeholder="Nama depan">
							</div>
							<div class="col-md-6">
								<!-- <label for="lname">Last Name</label> -->
								<input type="text" name="lname" id="lname" class="form-control" placeholder="Nama belakang">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="email">Email</label> -->
								<input type="text" name="email" id="email" class="form-control" placeholder="Alamat email">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="subject">Subject</label> -->
								<input type="text" name="subject" id="subject" class="form-control" placeholder="Subjek pesan">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<!-- <label for="message">Message</label> -->
								<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Katakan sesuatu untuk kami"></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Kirim Pesan" class="btn btn-primary">
						</div>

					</form>		
				</div>
			</div>
			
		</div>
	</div>
