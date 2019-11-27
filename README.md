# CodeIgniter Framework
### SQL for BLOG POST table
```
CREATE TABLE `codeigniter`.`post` ( 
    `id` INT NOT NULL AUTO_INCREMENT, 
    `title` VARCHAR(512) NOT NULL , 
    `content` TEXT NOT NULL , 
    `username` VARCHAR(512) NOT NULL , 
    `cover_image` VARCHAR(512) NULL , 
    `small_image` VARCHAR(512) NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
);
```
### Config
`application/config/database.php`
### Add Router
`application/config/routes.php`