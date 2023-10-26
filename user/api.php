<?php
require 'vendor/autoload.php'; // Include the Razorpay PHP library

use Razorpay\Api\Api;

$api_key = 'rzp_test_4x4SkOvOeVVpuH';
$api_secret = '4pwtP2L88bAOIokJZuf1XnlO';

$api = new Api($api_key, $api_secret);

// Example: Creating a new order
$orderData = [
    'amount' => 1000, // Amount in paise (e.g., 1000 paise = Rs. 10)
    'currency' => 'INR',
    'receipt' => 'order_rcptid_11',
];

try {
    $order = $api->order->create($orderData);
    echo 'Order ID: ' . $order->id;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>