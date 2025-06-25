<div id="colorlib-page">
	<?php include __DIR__ . '/../side_menu.php' ?>
	<!-- END COLORLIB-ASIDE -->
	<div id="colorlib-main">
		<section class="contact-section px-md-4 pt-5">
			<div class="container">
				<div class="row block-9">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-md-12 mb-1">
								<h3 class="h3">Пользователи</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 mb-1">
								<table class="table table-striped">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col">Name</th>
											<th scope="col">Surname</th>
											<th scope="col">Login</th>

											<th scope="col">E-mail</th>
											<th scope="col">Temp block</th>
											<th scope="col">Permanent block</th>
										</tr>
									</thead>
									<tbody>

										<?php 
											$users = $user->all_users();
											if ($users) {
												foreach ($users as $user_) {
													$error = (!empty($req->get('user_id')) && $req->get('user_id') == $user_->user_id && !empty($req->get('error'))) 
													? "<p>" . $req->get('error') . "</p>" 
													: "";

													echo "<tr>
															<th scope=\"row\">$user_->user_id</th>
															<td>$user_->_name</td>
															<td>$user_->_surname</td>
															<td>$user_->_login</td>
															<td>$user_->_email</td>
															<td>" 
															. ($user_->isAdmin ? "" : "<a href=\"" . $resp->getLink('/temp-block.php', ['user_id' => $user_->user_id]) . "\" class=\"btn btn-outline-warning px-4\">⏳Block</a>")
															. "</td>
															<td>" 
															. ($user_->isAdmin ? "" : "<a href=\""  . $resp->getLink('/imports/block.php', ['user_id' => $user_->user_id, 'block' => 'perm']) . "\" class=\"btn btn-outline-danger px-4\">📌 Block</a>") 
															. $error . "</td>
														</tr>";
												}
											}
										?>										

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->