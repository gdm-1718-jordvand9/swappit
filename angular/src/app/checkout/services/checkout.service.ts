import { Injectable } from '@angular/core';
import { MatStepper } from '@angular/material';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Subject } from 'rxjs/Subject';
import { Observable } from 'rxjs/Observable';
import { Subscription } from 'rxjs/Subscription';
import { Router } from '@angular/router';

/*
Settings
*/
import { environment } from '../../../environments/environment';

/*
Models
*/
import { Order } from '../../core/models/order';
import { Ticket } from '../../core/models/ticket';

/*
Services
*/
import { SwappitService } from '../../core/services/swappit.service';
import { CartService } from '../../core/services/cart.service';
import { SwappitAuthService } from '../../core/services/swappit-auth.service';


@Injectable()
export class CheckoutService {

  private _apiEndPointCheckoutAvailableAndSoldTickets = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.indexAvailableAndSold}`
  private _apiEndPointOrder = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.orders}`;
  private _apiEndPointPayOrder = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.payOrder}`
  // private _apiEndPointCancelOrder = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints.cancelOrder}`
  private _apiEndPointCheckoutCancel = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints["checkout/cancel"]}`;
  private _apiEndPointCheckoutPay = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints["checkout/pay"]}`;
  private _apiEndPointCheckoutSetConfirm = `${environment.SwappitApi.url}${environment.SwappitApi.endPoints["checkout/confirm/store"]}`;
  
  constructor(private _httpClient: HttpClient, private _swappitAuthService: SwappitAuthService, private _router: Router) { }
  
  getAvailableAndSoldTickets(tickets: Array<string>) {
    let postData = {
      tickets: tickets,
    }
    return this._httpClient.post<any>(`${this._apiEndPointCheckoutAvailableAndSoldTickets}`, postData);
  }

  createOrder(tickets: Array<string>) {
    let postData = {
      tickets: tickets,
    }
    return this._httpClient.post<Order>(`${this._apiEndPointOrder}`, postData);
  }

  getOrder(id: string) {
    return this._httpClient.get<Order>(`${this._apiEndPointOrder}/${id}`);
  }

  cancelOrder(id: string) {
    return this._httpClient.post(`${this._apiEndPointOrder}/cancel/${id}`, {});
  }

  payOrder(id: string) {
    return this._httpClient.post<any>(`${this._apiEndPointPayOrder}/${id}`, {});
  }


//
//
//
  

  




  /* confirmOrder()
  {
    let items = this._cartService.getCartItems();
    let itemsArray = [];
    items.map((item) => itemsArray.push(item.ticketId));
    this._swappitService.getCheckoutConfirm(itemsArray).subscribe(
      data => {
        this.tickets_sold = data.tickets_sold;
        this.tickets_available = data.tickets_available;
        console.log(data);
      },
      err => console.log(err),
      () => console.log('Succesfully fetched.')
    )
  }

  getAvailableTickets()
  {
    return this.tickets_available.asObservable();
  }

  getSoldTickets()
  {
    return this.tickets_sold.asObservable();
  }

  setCheckoutConfirm(tickets_available: Array<Ticket>)
  {
    let ticketArray = [];
    tickets_available.map((ticket) => ticketArray.push(ticket.id));
    this._swappitService.setCheckoutConfirm(ticketArray).subscribe(
      data => {
        console.log(data);
        this.order.next(data);
        this.next();
        this._cartService.clearCart();
      },
      err => console.log(err),
      () => console.log('Order successfully pushed.')
    )
  }

  setCheckoutPay(id: string)
  {
    this._swappitService.setCheckoutPay(id).subscribe(
      data => {
        console.log(data);
        this.next();
      },
      err => console.log(err),
      () => console.log('Successfully payed.')
    )
  } */


}
