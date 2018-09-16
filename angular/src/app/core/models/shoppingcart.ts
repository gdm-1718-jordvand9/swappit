import { CartItem } from "./cartitem";

export class ShoppingCart {
  items: CartItem[] = new Array<CartItem>();
  price_total: number = 0;

  public updateCart(src: ShoppingCart)
  {
    this.items = src.items;
    this.price_total = src.price_total;
  }
}