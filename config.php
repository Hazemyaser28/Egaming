<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51L5yDCA8o5GWaLN67yO7ectoeguxim6h3Pz4rBfMuE834yYPODohFbpRo9yUslGr2qh9z9zL1JHsqKfMNH5RYrNk00WV24srBq";

$secretKey="sk_test_51L5yDCA8o5GWaLN6f83BODeb6uQjHMguNy3iLY6YdC7u7hdWtNft9QjOhevlTcvRzFVSfnjgQ0QhkyeohNAgZbyU00MzXE6myh";

\Stripe\Stripe::setApiKey($secretKey);
?>