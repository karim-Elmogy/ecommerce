<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class HyperPayPaymentService
{
    public string $base_url_for_test = "https://eu-test.oppwa.com/v1/";
    public string $base_url_for_prod = "https://eu-prod.oppwa.com/v1/";
    public string $base_url = "";

    public function __construct(public array $data, $type = "production",public string $method = "VISA")
    {
        $this->data = $data;
        $this->base_url = $type == "production" ? $this->base_url_for_prod : $this->base_url_for_test;
    }

    public function checkout()
    {
        $method = $this->validate_method($this->method);
        $data = $this->prepare_data_for_checkout($this->data, $method);
        $validated = $this->validate_checkout($data);
        $id = $this->get_checkout_id($data);
        request()->session()->put('method', $method);
        return $this->get_view($id, $method);
    }

    public function get_view(string $id, string $method): string
    {
        $baseUrl = $this->base_url;
        $brands = $method;

        return <<<HTML
<style>
body{
/*background-color: #ccc;*/
}
.wpwl-form-card {
background-color: #9F85F3;

}
.center{
text-align: center;
margin: 100px 0;
}
</style>
<script src="{$baseUrl}/paymentWidgets.js?checkoutId={$id}"></script>
<script>
    var wpwlOptions = {
        style: "card"
    };
</script>
<div class="center">
 <img src="/assets/user/assets/img/logo/logo.png" alt="Logo" width="200" class="img-fluid">
</div>

<form action="" class="paymentWidgets" data-brands="{$brands}"></form>
HTML;
    }


    public function checkPaymentStatus()
    {
        $id = $_GET['id'];

        $method = request()->session()->get('method');

        $entityId = $this->getEntityId($method);
        return $this->handle('checkouts/' . $id . '/payment', env('HYPER_PAY_TOKEN','OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg'), [
            'entityId'=>$entityId
        ], 'get');


    }

    public function prepare_data_for_checkout(array $data, $method)
    {
        $data['entityId'] = $this->getEntityId($method);
        $data['amount'] = number_format((float)($data['amount'] ?? 0), 2, '.', '');
        $data['currency'] = "EUR";
        // $data['billing.country'] = "SA";
        $data['paymentType'] = "DB";
        $data['customParameters[3DS2_enrolled]'] = true;
        return $data;

    }

    public function validate_method(?string $method)
    {
        if (isset($method) && in_array($method, ['VISA', 'MASTER', 'MADA'])) {
            return $method;
        }
        return throw new \Exception("payment method has error");
    }

    public function getEntityId($method)
    {
        $entityId = env('visaMasterEntityId','8a8294174b7ecb28014b9699220015ca');
        if ($method == 'MADA') {

            $entityId = env('madaEntityId','8a8294174b7ecb28014b9699220015ca');


        }
        return $entityId;
    }

    /**
     * @throws \Exception
     */
    public function validate_checkout(array $data): bool
    {
        $required_keys = array_flip([
            'entityId', 'amount', 'currency', 'customParameters[3DS2_enrolled]',
            'customer.email', 'billing.street1', 'billing.city', 'billing.state', 'billing.postcode', 'customer.givenName',
            'customer.surname', 'merchantTransactionId', 'paymentType',
            'shopperResultUrl'
        ]);

        $missing_keys = array_diff_key($required_keys, $data);

        if (empty($missing_keys)) {
            return true;
        } else {
            return throw new \Exception("Missing keys: " . implode(', ', array_keys($missing_keys)));
        }

    }

    public function get_checkout_id(array $data)
    {
        $token = env('HYPER_PAY_TOKEN','OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg=');
        $response = $this->handle('checkouts', $token, $data);
        if (empty($response['body'])) {
            return throw new \Exception("UN KNOWN ERROR");
        } elseif (empty($response['body']['id'])) {
            return throw new \Exception($response['body']);
        } else {
            return $response['body']['id'];
        }
    }

    public function handle(string $route, ?string $token, array $data = [], string $method = 'post'): array
    {
        $response = Http::withToken($token)
            ->asForm() // Assuming form data, adjust if needed (e.g., ->asJson() for JSON)
            ->{$method}($this->base_url . $route, $data);

        return [
            'code' => $response->getStatusCode(), // Use getStatusCode() for clarity
            'body' => $response->json(),
        ];
    }

}
