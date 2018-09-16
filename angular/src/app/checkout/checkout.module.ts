import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CheckoutPageComponent } from './pages/checkout-page/checkout-page.component';
import { AppRoutingModule } from '../app-routing.module';
import { MaterialModule } from '../material/material.module';
import { CheckoutService } from './services/checkout.service';
import { CheckoutTicketsComponent } from './components/checkout-tickets/checkout-tickets.component';
import { CheckoutOrderComponent } from './components/checkout-order/checkout-order.component';
import { CheckoutConfirmedComponent } from './components/checkout-confirmed/checkout-confirmed.component';

@NgModule({
  imports: [
    CommonModule,
    AppRoutingModule,
    MaterialModule,
  ],
  declarations: [
    CheckoutPageComponent,
    CheckoutTicketsComponent, 
    CheckoutOrderComponent, 
    CheckoutConfirmedComponent,
  ],
  exports: [
    CheckoutPageComponent,
  ],
  providers: [CheckoutService],
})
export class CheckoutModule { }
