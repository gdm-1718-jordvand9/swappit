import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { SwappitAuthGuardService as SwappitGuard } from './core/services/swappit-auth-guard.service';
/*
Components as pages
*/
import { HomePageComponent } from './home/pages/home-page/home-page.component';
import { FestivalPageComponent } from './festival/pages/festival-page/festival-page.component';
import { NotFoundPageComponent } from './core/pages/not-found-page/not-found-page.component';
import { TicketsPageComponent } from './ticket/pages/tickets-page/tickets-page.component';
import { AccountPageComponent } from './account/pages/account-page/account-page.component';
import { AccountSettingsComponent } from './account/components/account-settings/account-settings.component';
import { AccountOrdersComponent } from './account/components/account-orders/account-orders.component';
import { AccountTicketsComponent } from './account/components/account-tickets/account-tickets.component';
import { SigninPageComponent } from './auth/pages/signin-page/signin-page.component';
import { TickettypePageComponent } from './tickettype/pages/tickettype-page/tickettype-page.component';
import { AccountTicketsCreateComponent } from './account/components/account-tickets-create/account-tickets-create.component';
import { CheckoutPageComponent } from './checkout/pages/checkout-page/checkout-page.component';
import { ContactPageComponent } from './contact/pages/contact-page/contact-page.component';
import { CheckoutTicketsComponent } from './checkout/components/checkout-tickets/checkout-tickets.component';
import { CheckoutOrderComponent } from './checkout/components/checkout-order/checkout-order.component';
import { CheckoutConfirmedComponent } from './checkout/components/checkout-confirmed/checkout-confirmed.component';
import { SignupPageComponent } from './auth/pages/signup-page/signup-page.component';
import { FestivalsPageComponent } from './festival/pages/festivals-page/festivals-page.component';
import { VerifyEmailPageComponent } from './auth/pages/verify-email-page/verify-email-page.component';
import { VerifiedEmailPageComponent } from './auth/pages/verified-email-page/verified-email-page.component';

const routes : Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'home', component: HomePageComponent },
  { path: 'festivals/:id' , component: FestivalPageComponent },
  { path: 'tickets' , component: TicketsPageComponent },
  { path: 'festivals' , component: FestivalsPageComponent },
  { path: 'ticket_types/:id' , component: TickettypePageComponent },
  { path: 'signin' , component: SigninPageComponent },
  { path: 'signup' , component: SignupPageComponent },
  { path: 'verify-email' , component: VerifyEmailPageComponent },
  { path: 'verified-email' , component: VerifiedEmailPageComponent },
  { path: 'contact' , component: ContactPageComponent },
  { path: 'account', component: AccountPageComponent, canActivate: [SwappitGuard], children: [
    { path: '', redirectTo:'settings', pathMatch: 'full'},
    { path: 'settings', component: AccountSettingsComponent},
    { path: 'orders', component: AccountOrdersComponent},
    { path: 'tickets', component: AccountTicketsComponent },
    { path: 'tickets/create', component: AccountTicketsCreateComponent},
    { path: 'tickets/edit/:id', component: AccountTicketsCreateComponent},
  ]},
  { path: 'checkout', component: CheckoutPageComponent, canActivate: [SwappitGuard], children: [
    { path: '', redirectTo: 'tickets', pathMatch: 'full'},
    { path: 'tickets', component: CheckoutTicketsComponent },
    { path: 'order/:id', component: CheckoutOrderComponent},
    { path: 'confirmed', component: CheckoutConfirmedComponent}
  ] },
  { path: '404', component: NotFoundPageComponent },
  { path: '**', redirectTo: '/404'},
];


@NgModule({
  imports: [
    RouterModule.forRoot(routes)
  ],
  declarations: [],
  exports: [
    RouterModule
  ],
})
export class AppRoutingModule { }
