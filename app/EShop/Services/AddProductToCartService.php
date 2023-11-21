<?php namespace App\EShop\Services;

use Exception;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\ProductAddedToCart;
use App\EShop\Services\Interfaces\ServiceInterface;


class AddProductToCartService implements ServiceInterface
{
    /**
     * Current cart.
     *
     * @var null
     */
    private $cart = null;


    /**
     * Main logic to add a Product
     * to the Cart.
     *
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function run(Request $request): mixed
    {
        return $this->findOrInitCart($request->cart_id)
                    ->addProduct($request->product_id, $request->quantity);
    }


    /**
     * Find an existing Cart by its UUID
     * or create a new one.
     *
     * @param string|null $cartId
     * @return $this
     */
    private function findOrInitCart(string $cartId = null): static
    {
        $this->cart = $cartId
                        ? Cart::findByUuid($cartId)
                        : Cart::init();

        return $this;
    }


    /**
     * Adding a product to a cart.
     *
     * @throws Exception
     */
    private function addProduct(string $productId, int $quantity)
    {
        // Validation rule makes sure product exists.
        $product = Product::findByUuid($productId);

        if ($cartItem = $this->cart->contains($product)) {
            $this->increaseQuantity($cartItem, $quantity);
        } else {
            $this->addAsNew($product, $quantity);
        }

        event(new ProductAddedToCart($this->cart, $product, $quantity));

        return $this->cart->refresh();
    }


    /**
     * Adds a product to cart as new entry.
     *
     * @param Product $product
     * @param int $quantity
     * @return AddProductToCartService
     */
    private function addAsNew(Product $product, int $quantity): AddProductToCartService
    {
        $this->cart
             ->items()
             ->attach($product->id, ['quantity' => $quantity]);

        return $this;
    }


    /**
     * Increase the existing quantity for item already in cart.
     *
     * @param Product $cartItem
     * @param int $quantity
     * @return AddProductToCartService
     */
    private function increaseQuantity(Product $cartItem, int $quantity): AddProductToCartService
    {
        $newQuantity = $cartItem->extra->quantity + $quantity;

        $this->cart
             ->items()
             ->updateExistingPivot($cartItem, ['quantity' => $newQuantity]);

        return $this;
    }
}
