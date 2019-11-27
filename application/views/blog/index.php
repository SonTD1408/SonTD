

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2>List Posts</h2>
                </div>
            </div>
            <div class="row">
				<?php
					$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
					$limit = 3;
					$total_page = ceil($numberrecord / $limit);
					if ($current_page > $total_page){
						$current_page = $total_page;
					}
					else if ($current_page < 1){
						$current_page = 1;
					}
					$start = ($current_page -1) * $limit;

					$this->load->model('PostModel');
					$result=$this->PostModel->get3dl($start,$limit);
					//var_dump($result);
					//$this->PostModel->get3dl($start,$limit);
					$row=$this->PostModel->getPost();

					?>
                <?php foreach($result as $arr) {?>
                    <?php
                        $postUrl =  base_url().'blog/view/'.$arr['id'];
                        $pageurl= base_url().'blog/view/';
                    ?>
                    <div class="col-lg-4 mb-4">
                        <div class="entry2">
                            <a href="<?php echo $postUrl?>">
                                <img src="<?php echo base_url()?>public/images/img_1.jpg" alt="Image" class="img-fluid rounded">
                            </a>
                            <div class="excerpt">
                                <span class="post-category text-white bg-secondary mb-3">Politics</span>

                                <h2><a href="<?php echo $postUrl?>"><?php echo $arr['title']; ?>.</a></h2>
                                <div class="post-meta align-items-center text-left clearfix">
                                    <span class="d-inline-block mt-1">By <a href="#">Carrol Atkinson</a></span>
                                    <span>&nbsp;-&nbsp; July 19, 2019</span>
                                </div>

                                <p style=""><?php echo $arr['content']; ?>.</p>
                                <p><a href="<?php echo $postUrl?>">Read More</a></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row text-center pt-5 border-top">
                <div class="col-md-12">
                    <div class="custom-pagination">


			<?php
			if ($current_page > 1 && $total_page > 1){
				echo '<a href="index.php?page='.($current_page-1).'">Prev</a> | ';
			}

			// Lặp khoảng giữa
			for ($i = 1; $i <= $total_page; $i++){
				// Nếu là trang hiện tại thì hiển thị thẻ span
				// ngược lại hiển thị thẻ a
				if ($i == $current_page){
					echo '<span>'.$i.'</span> | ';
				}
				else{
					echo '<a href="index.php?page='.$i.'">'.$i.'</a> | ';
				}
			}

			// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
			if ($current_page < $total_page && $total_page > 1){
				echo '<a href="index.php?page='.($current_page+1).'">Next</a> ';
			}
			?>
					</div>
				</div>
			</div>
	</div>
    </div>
