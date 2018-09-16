import { Component, OnInit } from '@angular/core';
import { CheckoutService } from '../../services/checkout.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Order } from '../../../core/models/order';

@Component({
  selector: 'app-checkout-order',
  templateUrl: './checkout-order.component.html',
  styleUrls: ['./checkout-order.component.scss']
})
export class CheckoutOrderComponent implements OnInit {

  private order: Order;
  private interval: any;
  loading: boolean = true;
  constructor(private _checkoutService: CheckoutService, private _route: ActivatedRoute, private _router: Router) { }

  ngOnInit() {
    const id = this._route.snapshot.params['id'];
    this.getOrder(id);
    this.watchRouteChanges();
  }

  getOrder(id: string): void {
    this._checkoutService.getOrder(id).subscribe(
      data => {

        console.log(data);
        if (data.status === 'placed') {
          this.order = data;
          this.startCancelTimer();
          this.loading = false;
        } else {
          this._router.navigate(['404']);
        }
      }
    )
  }

  payOrder(id: string): void {
    this._checkoutService.payOrder(id).subscribe(
      data => {
        console.log(data);
        this.stopCancelTimer();
        this._router.navigate(['checkout/confirmed'])
      }
    )
  }

  cancelOrder(id: string): void {
    console.log(this.order);
    this._checkoutService.cancelOrder(this.order.id).subscribe(
      data => {
        this.stopCancelTimer();
        this._router.navigate(['account/orders']);
      }
    )
  }
  watchRouteChanges(): void {
    let router = this._router.events.subscribe(() => {
      this.stopCancelTimer();
      router.unsubscribe();
    }
    );

  }
  startCancelTimer() {
    const today: any = new Date();
    const past_date: any = new Date(this.order.placed_at.date);
    const diffMs = today - past_date;
    const diffSec = Math.round(diffMs / 1000);
    let countdown = 1 * 60 - diffSec;
    this.interval = setInterval(() => {
      countdown = countdown - 1;
      let minutes = Math.floor(countdown / 60);
      let seconds = countdown % 60;
      this.order.cancel_timer = 'Time left to pay ' + minutes + ':' + seconds;
      console.log(this.order.cancel_timer);
      if (minutes === 0 && seconds === 0) {
        clearInterval(this.interval);
        this.order.cancel_timer = 'No time left, order will be cancelled.';
        console.log(this.order.cancel_timer);
        setTimeout(() => this._router.navigate(['account/orders']), 3000);
      }
    }, 1000);
  }

  stopCancelTimer() {
    console.log('STOPPING TIMER');
    clearInterval(this.interval);
  }

}
