<?php

return array (
  'name' => 'FlutterWave',
  'slug' => 'flutterwave',
  'image' => 'modules/flutterwave/images/logo.png',
  'title' => 'FlutterWave',
  'processing_fee' => '1',
  'subscription' => 0,
  'configs' => 
  array (
    'flw_public_key' => '',
    'flw_secret_key' => '',
    'flw_secret_hash' => '',
    'flw_sandbox_mode' => NULL,
  ),
  'fields' => 
  array (
    'title' => 
    array (
      'type' => 'text',
      'label' => 'Label',
    ),
    'processing_fee' => 
    array (
      'type' => 'number',
      'label' => 'Processing Fee',
    ),
    'flw_public_key' => 
    array (
      'type' => 'password',
      'label' => 'Public Key',
    ),
    'flw_secret_key' => 
    array (
      'type' => 'password',
      'label' => 'Secret Key',
    ),
    'flw_secret_hash' => 
    array (
      'type' => 'password',
      'label' => 'Secret Hash',
    ),
    'subscription' => 
    array (
      'type' => 'checkbox',
      'label' => 'Subscription',
    ),
  ),
);
