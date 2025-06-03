<div id="colorlib-page">
	<?php include __DIR__ . '/../side_menu.php' ?>
	<?php
		if ($req->isPost) {

			$data = $user->request->post();
			$user->load($data);
			
			if ($user->validateLogin()) {
				if ($user->login()) {
					$resp->redirect('/index.php', []);
					die();
				}
			}
		}
	?>

	<!-- END COLORLIB-ASIDE -->
	<div id="colorlib-main">
		<section class="contact-section px-md-2  pt-5">
			<div class="container">
				<div class="row d-flex contact-info">
					<div class="col-md-12 mb-1">
						<h2 class="h3">Авторизация</h2>
					</div>
				</div>
				<div class="row block-9">
					<div class="col-lg-6 d-flex">
						<form method="post" action="" class="bg-light p-5 contact-form">
							<div class="form-group">
								<input type="text" class="form-control <?= !empty($user->login_validate) ? 'is-invalid' : '' ?>" placeholder="Your Login"
									name="_login" value="<?= isset($data['_login']) ? $data['_login'] : '' ?>">
								<div class="invalid-feedback">
									<?= $user->login_validate ?>
								</div>
							</div>
							<div class="form-group">
								<input type="password" class="form-control <?= !empty($user->password_validate) ? 'is-invalid' : '' ?>" placeholder="Password"
									name="_password"> 
									<!-- value="<?= isset($data['_password']) ? $data['_password'] : '' ?>" -->
								<div class="invalid-feedback">
									<?= $user->password_validate ?>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Вход" class="btn btn-primary py-3 px-5">
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->