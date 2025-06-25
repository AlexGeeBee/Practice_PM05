<div id="colorlib-page">
	<?php include __DIR__ . '/../side_menu.php' ?>
	<!-- END COLORLIB-ASIDE -->
	<div id="colorlib-main">
		<section class="ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row d-flex">
					<div class="col-xl-8 py-5 px-md-2">
						<div class="row pt-md-4">
							
							<?php

							$posts_per_page = 5;
							$posts_count = count($post->post_feed());
							$pages = ceil($posts_count / $posts_per_page);

							if (intval($req->get('page')) && $req->get('page') > 0) {
								$current_page = $req->get('page');
							}
							else {
								$current_page = 1;
							}

							$posts = array_slice($post->post_feed(), ($current_page - 1) * $posts_per_page, $posts_per_page);

							foreach ($posts as $post) {
								$link = $menu->response->getLink('post.php', ['post' => $post->post_id]);

								echo "<div class=\"col-md-12\">
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
										<p><a href=\"$link\" class=\"btn-custom\">Подробнее... <span class=\"ion-ios-arrow-forward\"></span></a></p>
									</div>
								</div>
							</div>";
							} 
							?>

							<!-- <img src='avatar.jpg' /> -->
							<!-- 
								изображение для поста 
								<a href="single.html" class="img img-2"
								style="background-image: url(images/image_1.jpg);"></a> 
							-->


						</div><!-- END-->

						<!-- pagination -->
						<div class="row">
							<div class="col">
								<div class="block-27">
									<ul>
										<?php 
										$prev_link = $resp->getLink('/index.php', ['page' => $current_page - 1]);
										echo $current_page > 1 ? "<li><a href=\"$prev_link\">&lt;</a></li>" : "";
										
										for ($i = 1; $i <= $pages; $i++) {
												
											if ($i == $current_page) {
												echo "<li class=\"active\"><span>$i</span></li>";
												continue;
											}

											$link = $resp->getLink('/index.php', ['page' => $i]);
											echo "<li><a href=\"$link\">$i</a></li>";
										}

										$next_link = $resp->getLink('/index.php', ['page' => $current_page + 1]);
										echo $current_page < $pages ? "<li><a href=\"$next_link\">&gt;</a></li>" : "";
										?>

									</ul>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</section>
	</div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->