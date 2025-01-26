# OpenAPI\Client\DefaultApi

All URIs are relative to http://localhost/api, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**loginPost()**](DefaultApi.md#loginPost) | **POST** /login | Authenticate user and return JWT token |
| [**promoCodeActivatePost()**](DefaultApi.md#promoCodeActivatePost) | **POST** /promo-code/activate | Activate a promo code |
| [**signupPost()**](DefaultApi.md#signupPost) | **POST** /signup | Register a new user |


## `loginPost()`

```php
loginPost($login_post_request): \OpenAPI\Client\Model\LoginPost200Response
```

Authenticate user and return JWT token

Authenticates a user by email and password, and returns a JWT token along with user data.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$login_post_request = new \OpenAPI\Client\Model\LoginPostRequest(); // \OpenAPI\Client\Model\LoginPostRequest

try {
    $result = $apiInstance->loginPost($login_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->loginPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **login_post_request** | [**\OpenAPI\Client\Model\LoginPostRequest**](../Model/LoginPostRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\LoginPost200Response**](../Model/LoginPost200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `promoCodeActivatePost()`

```php
promoCodeActivatePost($promo_code_activate_post_request): \OpenAPI\Client\Model\PromoCodeActivatePost200Response
```

Activate a promo code

Activates a promo code for a specific user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$promo_code_activate_post_request = new \OpenAPI\Client\Model\PromoCodeActivatePostRequest(); // \OpenAPI\Client\Model\PromoCodeActivatePostRequest

try {
    $result = $apiInstance->promoCodeActivatePost($promo_code_activate_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->promoCodeActivatePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **promo_code_activate_post_request** | [**\OpenAPI\Client\Model\PromoCodeActivatePostRequest**](../Model/PromoCodeActivatePostRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\PromoCodeActivatePost200Response**](../Model/PromoCodeActivatePost200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signupPost()`

```php
signupPost($signup_post_request): \OpenAPI\Client\Model\SignupPost201Response
```

Register a new user

Registers a new user with the provided name, email, and password.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$signup_post_request = new \OpenAPI\Client\Model\SignupPostRequest(); // \OpenAPI\Client\Model\SignupPostRequest

try {
    $result = $apiInstance->signupPost($signup_post_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->signupPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **signup_post_request** | [**\OpenAPI\Client\Model\SignupPostRequest**](../Model/SignupPostRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\SignupPost201Response**](../Model/SignupPost201Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
