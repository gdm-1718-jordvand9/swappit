import { Injectable } from '@angular/core';
import { Ticket } from '../models/ticket';
import { CartItem } from '../models/cartitem';
import { ShoppingCart } from '../models/shoppingcart';
import { SidenavService } from './sidenav.service';

@Injectable()
export class CartService {

  constructor(private _sidenavService: SidenavService) { }

  getCart(): ShoppingCart {
    const cart = new ShoppingCart();
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
      console.log('Cart exists, updating cart.')
      cart.updateCart(JSON.parse(storedCart));
    }
    return cart;
  }

  addItem(ticket: Ticket): void {
    let cart = this.getCart();
    console.log(cart);
    let item = cart.items.find((x) => x.ticketId === ticket.id);
    if (item === undefined) {
      item = new CartItem();
      item.ticketId = ticket.id;
      item.price = ticket.price;
      item.setTicketType(ticket.ticket_type.id, ticket.ticket_type.name);
      item.setUser(ticket.user.id, ticket.user.name);
      item.setFestival(ticket.ticket_type.festival.id, ticket.ticket_type.festival.name);
      cart.items.push(item);
    }
    this.calculateCart(cart);
    this.saveCart(cart);
    console.log(JSON.parse(localStorage.getItem('cart')));
    this._sidenavService.toggleCartSideNav();
  }

  saveCart(cart: ShoppingCart): void {
    localStorage.setItem('cart', JSON.stringify(cart));
  }

  clearCart(): void {
    localStorage.removeItem('cart');
    this._sidenavService.closeCartSideNav();
  }

  calculateCart(cart: ShoppingCart): void{
    if(cart.items.length > 0) {
      cart.price_total  = cart.items.map((item) => parseFloat(item.price) ).reduce((previous, current) => previous + current);
      console.log(cart.price_total);
    }
    else {
      cart.price_total = 0;
    }
  }

  removeItem(cartitem: CartItem): void {
    let cart = this.getCart();
    let item = cart.items.findIndex((x) => x.ticketId === cartitem.ticketId);
    cart.items.splice(item,1);
    this.calculateCart(cart);
    this.saveCart(cart);
  }

  getCartItems(): Array<CartItem> {
    let cart = this.getCart();
    let items = cart.items;
    return items;
  }


}
