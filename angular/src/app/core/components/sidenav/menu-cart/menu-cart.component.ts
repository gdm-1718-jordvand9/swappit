import { Component, OnInit } from '@angular/core';
import { CartService } from '../../../services/cart.service';
import { ShoppingCart } from '../../../models/shoppingcart';
import { SidenavService } from '../../../services/sidenav.service';
import { CartItem } from '../../../models/cartitem';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menu-cart',
  templateUrl: './menu-cart.component.html',
  styleUrls: ['./menu-cart.component.scss']
})
export class MenuCartComponent implements OnInit {
  
  shoppingCart: ShoppingCart;

  constructor(private _cartService: CartService, private _sidenavService: SidenavService, private _router: Router) { }

  ngOnInit() {
    this.getCart();
    this._sidenavService.cartSidenav.openedStart.subscribe(() => this.getCart());
  }

  close() {
    this._sidenavService.closeCartSideNav();
  }

  getCart(): void {
    this.shoppingCart = this._cartService.getCart();
    console.log(this.shoppingCart);
  }

  clearCart(): void {
    this._cartService.clearCart();
  }

  removeItem(item: CartItem){
    this._cartService.removeItem(item);
    this.getCart();
  }

  checkout()
  {
    this._sidenavService.closeCartSideNav();
  }

}
