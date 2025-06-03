<div id="colorlib-page">
	<?php include __DIR__ . '/../side_menu.php' ?>
	<?php 
		if ($req->isPost) {

			$data = $user->request->post();
			$user->load($data);

			if ($user->validateRegister()) {
				
				if ($user->save()) {
					$resp->redirect('/index.php', []);
					die();
				}
			}
		}
	?>
	
	<!-- END COLORLIB-ASIDE -->
	<div id="colorlib-main">
		<section class="contact-section px-md-2 pt-5">
			<div class="container">
				<div class="row d-flex contact-info">
					<div class="col-md-12 mb-1">
						<h2 class="h3">Регистрация</h2>
					</div>

				</div>
				<div class="row block-9">
					<div class="col-lg-6 d-flex">
						<!-- imports/register_init.php -->
						<form method="post" action="" class="bg-light p-5 contact-form">
							
							<div class="form-group">
								<input type="text" class="form-control <?= !empty($user->name_validate) ? 'is-invalid' : '' ?>" placeholder="Your Name" name="_name" value="<?= isset($data['_name']) ? $data['_name'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->name_validate ?>
								</div>

							</div>
							<div class="form-group">
								<input type="text" class="form-control <?= !empty($user->surname_validate) ? 'is-invalid' : '' ?>" placeholder="Your Surname" name="_surname" value="<?= isset($data['_surname']) ? $data['_surname'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->surname_validate ?>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control <?= !empty($user->patronymic_validate) ? 'is-invalid' : '' ?>" placeholder="Your Patronymic"
									name="patronymic" value="<?= isset($data['patronymic']) ? $data['patronymic'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->patronymic_validate ?>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control <?= !empty($user->login_validate) ? 'is-invalid' : '' ?>" placeholder="Your Login"
									name="_login" value="<?= isset($data['_login']) ? $data['_login'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->login_validate ?>
								</div>
							</div>
							<div class="form-group">
								<input type="email" class="form-control <?= !empty($user->email_validate) ? 'is-invalid' : '' ?>" placeholder="Your Email"
									name="_email" value="<?= isset($data['_email']) ? $data['_email'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->email_validate ?>
								</div>
							</div>
							<div class="form-group">
								<input type="password" class="form-control <?= !empty($user->password_validate) ? 'is-invalid' : '' ?>" placeholder="Password"
									name="_password" value="<?= isset($data['_password']) ? $data['_password'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->password_validate ?>
								</div>
							</div>
							<div class="form-group">
								<input type="password" class="form-control <?= !empty($user->password_repeat_validate) ? 'is-invalid' : '' ?>" placeholder="Password repeat"
									name="_password_repeat" value="<?= isset($data['_password_repeat']) ? $data['_password_repeat'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->password_repeat_validate ?>
								</div>
							</div>



							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input is-invalid" type="checkbox" value="" id="rules"
										aria-describedby="invalidCheck3Feedback" required>
									<label class="form-check-label" for="rules">
										Rules
									</label>
									<div id="rulesFeedback" class="invalid-feedback">
										Необходимо согласиться с правилами регистрации.
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Регистрация" class="btn btn-primary py-3 px-5">
							</div>
						</form>

					</div>


				</div>
			</div>
		</section>
	</div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->