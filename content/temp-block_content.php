<div id="colorlib-page">
	<?php include __DIR__ . '/../side_menu.php' ?>
	<?php 
	$user_id = $req->get('user_id');

	if (empty($user_id) || !intval($user_id) || !$user->findOne($user_id)) {
		$resp->redirect('/index.php', []);
		die();
	} ?>
	<!-- END COLORLIB-ASIDE -->
	<div id="colorlib-main">
		<section class="contact-section px-md-2  pt-5">
			<div class="container">
				<div class="row d-flex contact-info">
					<div class="col-md-12 mb-1">
						<h2 class="h3">Временная блокировка пользователя</h2>
						<div>
							Пользователь: <?= $user->findOne($req->get('user_id'))['_login'] ?>
						</div>
					</div>
				</div>
				<div class="row block-9">
					<div class="col-lg-6 d-flex">
						<form action="<?= $resp->getLink('/imports/block.php', []) ?>" class="bg-light p-5 contact-form">
							<div class="form-group">
								<label for="date-block">Заблокировать до:</label>
								<input type="text" class="form-control <?= !empty($req->get('error')) ? 'is-invalid' : '' ?>" id="date-block" name="block_date" value="" required>
								<div class="invalid-feedback">
									<?= !empty($req->get('error')) ? $req->get('error') : '' ?>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" value="Блокировать" class="btn btn-primary py-3 px-5">
							</div>
							<input type="hidden" name="user_id" value="<?= $req->get('user_id') ?>">
							<input type="hidden" name="block" value="temp">
							<input type="hidden" name="token" value="<?= $user->token ?>">
						</form>
					</div>
				</div>
			</div>
		</section>
	</div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->