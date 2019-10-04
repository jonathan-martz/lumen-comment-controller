### Installations


add to routes/web.php
```php
$router->get('/comments', 'CommentController@select');
$router->get('/comment', 'CommentController@view');
```
