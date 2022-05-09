<?php

namespace App\Services;

use Illuminate\Http\Request;
use Validator;
use \Stripe\StripeClient;

use Datetime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Empresa;
use App\Models\EmpresaDatos;
use App\Models\EstablecimientoClienteStripe;
use App\Models\Paquete;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Auth;

class StripeService
{

    public static function getStripeAccount($empresaId)
    {
        $user = Auth::user();
        if ($user && $user->rol == 'cliente') {
            $empresa = Empresa::where('id', $empresaId)->with('datos')->first();

            return ($empresa && $empresa->datos && $empresa->datos->stripe_account_id) ? $empresa->datos->stripe_account_id : null;
        } else {
            return null;
        }
    }

    public static function confirmPayment($paymentIntents)
    {

        $stripe = new StripeClient(config('stripe.key'));
        return $stripe->paymentIntents->confirm($paymentIntents, ['payment_method' => 'pm_card_visa']);
    }

    public static function getStripeCustomer($establecimientoId, $accountId)
    {

        $user = Auth::user();

        $customerId = null;

        if ($user && $user->rol == 'cliente') {

            // $clienteId = $user->cliente()->first()->id;
            $customer = EstablecimientoClienteStripe::where('establecimiento_id', $establecimientoId)->where('user_id', $user->id)->first();

            if (!$customer) {
                $stripe = new StripeClient(config('stripe.key'));
                $customer = $stripe->customers->create([
                    'email' => $user->email,
                    'name' => $user->nombre . ($user->apellidos ? $user->apellidos : '')
                ], ['stripe_account' =>  $accountId]);
                $customer = EstablecimientoClienteStripe::create([
                    'establecimiento_id' => $establecimientoId,
                    'user_id' => $user->id,
                    'stripe_customer_id' => $customer->id
                ]);
            }

            $customerId = $customer->stripe_customer_id;
        } else {
            $datos = EmpresaDatos::where('empresa_id', $establecimientoId)->first();
            if ($datos) {
                $customerId = $datos->stripe_customer_id;
            }
        }

        return $customerId;
    }

    public static function getComision($accountId)
    {
        $comision = null;

        if ($accountId) {
            $empresaDatos = EmpresaDatos::where('stripe_account_id', $accountId)->with('empresa')->first();
            if ($empresaDatos && $empresaDatos->empresa && $empresaDatos->empresa->paquete_id) {
                $paquete = Paquete::find($empresaDatos->empresa->paquete_id);
                if ($paquete && $paquete->comision_transaccion) {
                    $comision = $paquete->comision_transaccion;
                }
            }
        }

        return $comision;
    }

    public static function getPaymentMethods($customerId, $accountId)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $metodos_pago_cliente = $stripe->paymentMethods->all([
            'customer' => $customerId,
            'type' => 'card',
        ], ['stripe_account' =>  $accountId]);

        return $metodos_pago_cliente;
    }

    public static function createPaymentMethod($customerId, $card, $accountId, $default = false)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $metodo_pago = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => $card,
        ], ['stripe_account' =>  $accountId]);

        $stripe->paymentMethods->attach($metodo_pago->id, [
            'customer' => $customerId
        ], ['stripe_account' =>  $accountId]);

        if ($default) {
            $stripe->customers->update($customerId, [
                'invoice_settings' => ['default_payment_method' => $metodo_pago->id]
            ], ['stripe_account' =>  $accountId]);
        }

        return $metodo_pago;
    }

    public static function updateDefaultPaymentMethod($customerId, $accountId, $paymentMethodId)
    {
        $stripe = new StripeClient(config('stripe.key'));

        $stripe->paymentMethods->attach($paymentMethodId, [
            'customer' => $customerId
        ], ['stripe_account' =>  $accountId]);

        $customer = $stripe->customers->update($customerId, [
            'invoice_settings' => ['default_payment_method' => $paymentMethodId]
        ], ['stripe_account' =>  $accountId]);

        return $customer;
    }

    // TRANSFERENCIAS 

    public static function paymentIntentTransferGroup($totalPedido, $user)
    {


        $stripe = new \Stripe\StripeClient(config('stripe.key'));
        // Se crea el cargo directo.
        $payment_intent = $stripe->paymentIntents->create([
            'payment_method_types' => ['card'],
            'amount' => round($totalPedido, 2) * 100,
            'currency' => 'eur',
            'customer' => $user->customer_id,
        ]);




        return $payment_intent;
    }

    public static function getInfoPaymentMethod($idPaymentMethod)
    {

        try {
            $stripe = new StripeClient(config('stripe.key'));

            $paymentMethod = $stripe->paymentMethods->retrieve(
                $idPaymentMethod,
                []
            );
            return $paymentMethod;
        } catch (\Exceptions $e) {
            return $this->sendError($e);
        }
    }


    public static function transferGroup($cuentasDestinadas)
    {

        \Stripe\Stripe::setApiKey(config('stripe.key'));

        $stripe = new StripeClient(config('stripe.key'));
        $cargosCliente = $stripe->charges->all(
            ['customer' => auth()->user()->customer_id],
        );

        $cargoId = $cargosCliente->data[0]['id'];



        foreach ($cuentasDestinadas as $key => $cuenta) {
            $importeTotalProducto = $cuenta['importeTotalProducto'] * 100;
            // $gastoEnvio =  $cuenta['gasto_envios'] * 100;

            \Stripe\Transfer::create([
                'amount' => $importeTotalProducto,
                'currency' => 'eur',
                'source_transaction' => $cargoId,
                'description' => 'Transferencia realizada a  ' . $cuenta['establecimiento'],
                'destination' => $cuenta['account_id'],
                'transfer_group' => '{ORDER10}',
            ]);
        }

        return response()->json("ok");
    }



    // 


    public static function createPaymentIntents($customerId, $accountId, $pago)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $paymentIntents = $stripe->paymentIntents->create([
            'amount' => $pago * 100,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'customer' => $customerId
        ], ['stripe_account' =>  $accountId]);

        return $paymentIntents->client_secret;
    }





    public static function createCustomer($user)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $customer = $stripe->customers->create([
            'email' => $user->email,
            'name' => $user->nombre . ($user->apellidos ? $user->apellidos : '')
        ], ['stripe_account' =>  config('stripe.account')]);

        return $customer;
    }


    public static function getCustomer($cliente, $cuenta)
    {
        $stripe = new StripeClient(config('stripe.key'));


        try {

            if (auth()->user()->customer_id) {
                $stripe->customers->retrieve($cliente, [], ['stripe_account' => $cuenta]);
            }
        } catch (\Throwable $th) {
            // $clienteId = StripeService::createCustomer(auth()->user(),$cuenta)->id;
            // $user = User::find(auth()->user()->id);
            // $user->customer_id = $clienteId;
            // $user->update();
        }
    }



    public static function createProduct($nombre, $descripcion, $precio, $intervalo, $intervaloCount, $accountId = null)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $product = $stripe->products->create([
            'name' => $nombre,
            'description' => $descripcion
        ], ['stripe_account' =>  $accountId]);

        $price = $stripe->prices->create([
            'unit_amount' => $precio * 100,
            'currency' => 'eur',
            'recurring' => ['interval' => $intervalo, 'interval_count' => $intervaloCount],
            'product' => $product->id,
        ], ['stripe_account' =>  $accountId]);

        return ['product_id' => $product->id, 'price_id' => $price->id];
    }

    public static function updateProduct($product_id, $price_id, $nombre, $descripcion, $precio, $intervalo, $intervaloCount, $accountId = null)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $product = $stripe->products->update($product_id, [
            'name' => $nombre,
            'description' => $descripcion
        ], ['stripe_account' =>  $accountId]);

        $stripe->prices->update($price_id, [
            'active' => false
        ], ['stripe_account' =>  $accountId]);

        $price = $stripe->prices->create([
            'unit_amount' => $precio * 100,
            'currency' => 'eur',
            'recurring' => ['interval' => $intervalo, 'interval_count' => $intervaloCount],
            'product' => $product->id,
        ], ['stripe_account' =>  $accountId]);

        return ['product_id' => $product->id, 'price_id' => $price->id];
    }

    private static function fechaSuscripcion($fecha)
    {
        $hoy = Carbon::today();
        $fecha_inicio = new Carbon($fecha);
        $diferencia = $hoy->diffInDays($fecha_inicio, false);

        return ['diferencia' => $diferencia, 'fecha' => $fecha_inicio];
    }



    
    public static function createSubscription()
    {
 
    }

    public static function retrieveSubscription($subscriptionId, $accountId = null)
    {
        $stripe = new StripeClient(config('stripe.key'));

        if ($accountId) {
            $subscription = $stripe->subscriptions->retrieve($subscriptionId, [], ['stripe_account' =>  $accountId]);
        } else {
            $subscription = $stripe->subscriptions->retrieve($subscriptionId, []);
        }

        return $subscription;
    }

    public static function cancelSubscription($subscriptionId, $accountId = null)
    {
        $stripe = new StripeClient(config('stripe.key'));

        $comision = static::getComision($accountId);
        if ($accountId) {
            $subscription = $stripe->subscriptions->cancel($subscriptionId, [], ['stripe_account' =>  $accountId]);
        } else {
            $subscription = $stripe->subscriptions->cancel($subscriptionId, []);
        }

        return $subscription;
    }

    public static function createRefound($intentId, $pago, $comision, $accountId = null)
    {
        $stripe = new StripeClient(config('stripe.key'));

        $refound = $stripe->refunds->create([
            'payment_intent' => $intentId,
            'reason' => 'requested_by_customer',
            // 'refund_application_fee' => false,
            'amount' => ($pago * 100) - $comision
        ], ['stripe_account' =>  $accountId]);

        return $refound;
    }

    public static function createAccount($user)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $account = $stripe->accounts->create([
            'type' => 'standard',
            'country' => 'ES',
            'email' => $user->email
        ]);

        return $account;
    }

    public static function configAccount($accountId)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $account_links = $stripe->accountLinks->create([
            'account' => $accountId,
            'refresh_url' => config('global.return_url_stripe')[config('global.enviroment')],
            'return_url' => config('global.return_url_stripe')[config('global.enviroment')],
            'type' => 'account_onboarding',
        ]);

        return $account_links;
    }


    public static function statusAccount($accountId)
    {
        $userId = \Auth::user()->id;
        $data = [];
        $stripe = new StripeClient(config('stripe.key'));
        $account = $stripe->accounts->retrieve($accountId);

        if ($account && ($account->charges_enabled || $account->payouts_enabled && count($account->requirements->pending_verification) == 0)) {
            $data['status'] = true;
            $data['mensaje'] = "Cuenta Configurada correctamente";
        } else {
            // Si no, devolver un mensaje dependiendo de si falta o no introducir verificación.

            if (count($account->requirements->pending_verification) > 0) {
                $data['mensaje'] = "La plataforma STRIPE, esta verificando la información de su cuenta, esto puede demorar unos minutos";
            } else {
                $data['mensaje'] = "Se necesitan documentos de identidad, para finalizar la configuración de la cuenta";
            }
            $data['status'] = false;
        }
        return $data;
        // return response()->json($data);
    }


    public static function checkAccount($accountId)
    {
        $data = [];
        $stripe = new StripeClient(config('stripe.key'));
        $account = $stripe->accounts->retrieve($accountId);

        if ($account && ($account->charges_enabled || $account->payouts_enabled)) {
            return true;
        } else {
            return false;
        }
    }

    public static function createCupon($nombre, $cantidad, $accountId = null, $tipoCupon)
    {
        $stripe = new StripeClient(config('stripe.key'));

        // 1 Precio Fijo.

        // 2 Precio con descuento.

        if ($tipoCupon == 1) {

            $cupon = $stripe->coupons->create([
                'name' => $nombre,
                'amount_off' => $cantidad * 100,
                'currency' => 'eur',
                'duration' => 'forever'
            ], ['stripe_account' =>  $accountId]);
        } else if ($tipoCupon == 2) {


            $cupon = $stripe->coupons->create([
                'name' => $nombre,
                'percent_off' => $cantidad,
                'currency' => 'eur',
                'duration' => 'forever'
            ], ['stripe_account' =>  $accountId]);
        }
        return $cupon;
    }


    public static function getCupon($cuponId)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $cupon = $stripe->coupons->retrieve($cuponId);

        return $cupon;
    }

    public static function listarCupones()
    {
        $stripe = new StripeClient(config('stripe.key'));
        return $stripe->coupons->all();
    }


    public static function deleteCupon($cuponId, $accountId = null)
    {
        $stripe = new StripeClient(config('stripe.key'));
        $cupon = $stripe->coupons->delete($cuponId, [], ['stripe_account' => $accountId]);

        return $cupon;
    }

    public static function updateCupon($nombre, $tipo, $idCupon, $account, $cantidad)
    {

        $auxStripeService = new StripeService();

        $auxStripeService->deleteCupon($idCupon, $account);

        return $auxStripeService->createCupon($nombre, $cantidad, $account = null, $tipo);
    }
}
