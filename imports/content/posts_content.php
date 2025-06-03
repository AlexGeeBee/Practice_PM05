<div id="colorlib-page">
	<?php include __DIR__ . '/../side_menu.php' ?>
	<!-- END COLORLIB-ASIDE -->
	<div id="colorlib-main">
		<section class="ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row d-flex">
					<div class="col-xl-8 col-md-8 py-5 px-md-2">
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div>
									<?php if (!$user->isGuest && !$user->isAdmin) {
										$link = $menu->response->getLink('post-create.php', []);
										echo "<a href=\"$link\" class=\"btn btn-outline-success\">📝 Создать пост</a>";
									} ?>
								</div>
							</div>
						</div>
						<div class="row pt-md-4">

							<?php
							$posts = $post->posts_list();

							foreach ($posts as $post) {
								$link = $menu->response->getLink('post.php', ['post' => $post->post_id]);
								$edit_link = $resp->getLink('post-create.php', ['post' => $post->post_id]);
								$delete_link = $resp->getLink('imports/post_delete.php', ['post' => $post->post_id]);
								$actions = '';

								if ($user->isAdmin) {
									$actions = "<a href=\"$delete_link\" class=\"text-danger\" style=\"font-size: 1.8em;\"
													title=\"Удалить\">🗑</a>";
								} 
								elseif (!$user->isGuest && $post->user_id === $user->user_id) {
									$actions = "<a href=\"$edit_link\" class=\"text-warning\" style=\"font-size: 1.8em;\" title=\"Редактировать\">🖍</a>";
									if ($post->comments_count == 0) {
										$actions .= "<a href=\"$delete_link\" class=\"text-danger\" style=\"font-size: 1.8em;\" title=\"Удалить\">🗑</a>";
									}
												
								}

								echo "<div class=\"col-md-12 col-xl-12\">
								<div class=\"blog-entry ftco-animate d-md-flex\">
									
									<div class=\"text text-2 pl-md-4\">
										<h3 class=\"mb-2\"><a href=\"$link\">$post->_title</a></h3>
										<div class=\"meta-wrap\">
											<p class=\"meta\">
												<span class=\"text text-3\">$post->user_login</span>
												<span><i class=\"icon-calendar mr-2\"></i>{$post->post_datetime()}</span>
												<span><i class=\"icon-comment2 mr-2\"></i>$post->comments_count comments</span>
											</p>
										</div>
										<p class=\"mb-4\">$post->_preview</p>
										<div class=\"d-flex pt-1  justify-content-between\">
											<div>
												<a href=\"$link\" class=\"btn-custom\">
													Подробнее... <span class=\"ion-ios-arrow-forward\"></span></a>
											</div>

											<div>
												$actions
											</div>

										</div>
									</div>
								</div>
							</div>";
							}
							?>

							<!-- 
								изображение для поста 
								<a href="single.html" class="img img-2"
								style="background-image: url(images/image_1.jpg);"></a> 
							-->
							<!-- <img src='avatar.jpg' /> -->

						</div><!-- END-->

						<!-- 
								pagination
								<div class="row">
								<div class="col">
									<div class="block-27">
										<ul>
											<li><a href="#">&lt;</a></li>
											<li class="active"><span>1</span></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li><a href="#">&gt;</a></li>
										</ul>
									</div>
								</div>
							</div> -->

					</div>

				</div>
			</div>
		</section>
	</div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->