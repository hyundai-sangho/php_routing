<?php

$routes = [];

route('/', function () {
  echo "Home Page";
});

route('/login', function () {
  echo 'Login Page';
});

route('/about-us', function () {
  header('Location: /about-us.html');
});

route('/404', function () {
  echo "Page not found";
});

function route(string $path, callable $callback)
{
  global $routes;
  $routes[$path] = $callback;
}

run();

function run()
{
  global $routes;
  $found = false;
  $uri = $_SERVER['REQUEST_URI'];
  echo '$uri값: ' . $uri;
  echo '<br>';

  foreach ($routes as $path => $callback) {
    if ($path !== $uri) continue;

    $found = true;
    $callback();
  }

  if (!$found) {
    $notFoundCallback = $routes['/404'];
    $notFoundCallback();
  }
}