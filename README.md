### Installations


add to routes/web.php
```php
$router->post('/comments', 'CommentController@select');
$router->post('/comment', 'CommentController@view');
```
