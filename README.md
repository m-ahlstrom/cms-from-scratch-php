# CMS from Scratch

A basic CMS built with PHP from scratch. The code in this project is based on the [PHP for Beginners](https://www.udemy.com/course/php-for-beginners-/) course by Dave Hollingworth from Udemy.

## Steps to build it locally:

First of all, start Apache and MariaDB/MySQL e. g. in XAMPP.

<details>
  <summary>1. Clone git repository.</summary>

```
git clone https://github.com/m-ahlstrom/cms_from_scratch_php.git
```

</details>

<details>
  <summary>2. In phpMyAdmin, set up your database. First create a new database with a custom name, then on the SQL tab, run the following query.</summary>

```SQL
CREATE TABLE `articles` (
  `id` int(20) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `image_file` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `published_at` (`published_at`);

ALTER TABLE `article_category`
  ADD PRIMARY KEY (`article_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `articles`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```

</details>

<details>
  <summary>3. In the root directory, create a config.php file with the following contents.</summary>

```php
<?php

/**
 * Configuration settings
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'YOUR-DB-NAME');
define('DB_USER', 'YOUR-DB-USERNAME');
define('DB_PASS', 'YOUR-DB-PASSWORD');

define('SMTP_HOST', 'YOUR-SMTP-SERVER');
define('SMTP_USER', 'YOUR-EMAIL-ADDRESS');
define('SMTP_PASS', 'YOUR-EMAIL-PASSWORD');

// * Must also refresh the contact.php $mail contents with valid e-mail data.

define('SHOW_ERROR_DETAIL', true);

```

</details>

Done.

## Functionality

You can <strong>read articles</strong> in the main index page, <strong>send an e-mail</strong>, <strong>log in</strong> or <strong>register a new user</strong>. If you are logged in, you can view <strong>the admin panel</strong> or <strong>log out</strong>. In the admin panel you can: <strong>add</strong> articles, <strong>edit</strong> articles, <strong>delete</strong> articles, <strong>publish articles</strong> that have no publish date yet, <strong>upload images</strong> to articles and <strong>delete</strong> article <strong>images</strong>. Finally, you can <strong>add categories</strong> for articles (but you have to have categories for that in the categories table).
