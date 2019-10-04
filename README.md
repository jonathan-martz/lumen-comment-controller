### Installations


add to routes/web.php
```php
$router->post('/comment/select', 'CommentController@select');
$router->post('/comment/view', 'CommentController@view');
```
