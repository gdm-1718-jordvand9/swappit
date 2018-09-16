import { Component, OnInit } from '@angular/core';
import { CheckoutService } from '../../services/checkout.service';
import { Ticket } from '../../../core/models/ticket';
import { CartService } from '../../../core/services/cart.service';
import { CartItem } from '../../../core/models/cartitem';
import { Order } from '../../../core/models/order';
import { Router } from '@angular/router';

@Component({
  selector: 'app-checkout-tickets',
  templateUrl: './checkout-tickets.component.html',
  styleUrls: ['./checkout-tickets.component.scss']
})
export class CheckoutTicketsComponent implements OnInit {

  private tickets_sold = Array<Ticket>();
  private tickets_available =  Array<Ticket>();
  private cart_items = Array<CartItem>();
  private tickets_id = Array<string>();
  private tickets_available_id= Array<string>();
  private order: Order;
  constructor(private _checkoutService: CheckoutService, private _cartService: CartService, private _router: Router) { }

  ngOnInit() {
    this.getAvailableAndSoldTickets();
  }
  getAvailableAndSoldTickets(): void {
    this.cart_items = this._cartService.getCartItems();
    if (this.cart_items.length) {
      this.cart_items.map((item) => this.tickets_id.push(item.ticketId));
      this._checkoutService.getAvailableAndSoldTickets(this.tickets_id).subscribe(
        data => {
          console.log(data);
          this.tickets_available = data.tickets_available;
          this.tickets_sold = data.tickets_sold;
        }
      )
    }
  }

  createOrder(): void {
    this.tickets_available.map((ticket) => this.tickets_available_id.push(ticket.id));
    this._checkoutService.createOrder(this.tickets_available_id).subscribe(
      data => {
        this.order = data;
        this._cartService.clearCart();
        this._router.navigate([`checkout/order/${this.order.id}`])
      }
    )
  }

}
