<?php namespace App\EShop\Services;

use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\OrderCompleted;
use App\EShop\Services\Interfaces\ServiceInterface;


class CheckoutService implements ServiceInterface
{
    private $order = null;

    /**
     * @param Request $request
     * @return Order|null
     */
    public function run(Request $request)
    {
        $cart = Cart::findByUuid($request->cart_id);

        $this->makeOrder($cart)
             ->addAddress($request);

        $this->order->save();

        event(new OrderCompleted($this->order));

        return $this->order->load('user');
    }


    /**
     * @param Cart $cart
     * @return $this
     */
    private function makeOrder(Cart $cart)
    {
        $this->order               = new Order;
        $this->order->uuid         = Str::uuid();
        $this->order->cart_id      = $cart->id;
        $this->order->total_amount = $cart->value;
        $this->order->amount_paid  = $cart->calculateCurrentValue();
        $this->order->paid_at      = now();

        return $this;
    }


    /**
     * @param Request $request
     * @return $this
     */
    private function addAddress(Request $request)
    {
        // In case of logged in user. User their details.
        if ($user = auth('api')->user()) {
            $this->order->user_id = $user->id;
            return $this;
        }

        // Use new user for address details.
        $newUser = User::create([
            'uuid'    => Str::uuid(),
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
        ]);

        // When password is present in request
        // Register as new user
        // Validation Rule makes sure username is also present.
        if ($request->has('password')) {
            $newUser = $newUser->register($request->username, $request->password);
        }

        $this->order->user_id = $newUser->id;

        return $this;
    }
}
