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
							$posts = $post->post_feed();

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