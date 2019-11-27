<h1>Admin index page</h1>
<h1>Welcome <?php echo $adminEmail ?></h1>
<a href="<?php echo base_url() ?>admin/createBlog">Create Blog</a>
<br>
<a href="<?php echo base_url() ?>admin/changeBlog">Change blog by ID</a>
<br>
<a href="<?php echo base_url() ?>admin/logout">Logout</a>
<br>
<strong>List all posts in this system</strong>
<br>
<ul>
<?php foreach ($blogList as $post){ ?>
<li>
    <strong>Blog title</strong> <?php echo $post['title'] ?>
    <br>
    <strong>Blog content</strong> <?php echo $post['content'] ?>
    <br>
    <a href="<?php echo base_url() ?>admin/deletePost/<?php echo $post['id'] ?>">Delete this post ?</a>
</li>
<?php } ?>
</ul>
