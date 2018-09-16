import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

/*
Modules
*/
import { CoreModule } from './core/core.module';
import { MaterialModule } from './material/material.module';
import { AppRoutingModule } from './app-routing.module';
import { HomeModule } from './home/home.module';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { TicketModule } from './ticket/ticket.module';
import { FestivalModule } from './festival/festival.module';
import { AccountModule } from './account/account.module';
import { AuthModule } from './auth/auth.module';
import { TickettypeModule } from './tickettype/tickettype.module';

/*
Components
*/
import { AppComponent } from './app.component';
import { TicketDialogComponent } from './core/components/dialog/ticket-dialog/ticket-dialog.component';
import { CheckoutModule } from './checkout/checkout.module';
import { ContactModule } from './contact/contact.module';
import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { SwappitInterceptor } from './core/interceptors/swappit-interceptor';
import { OrderDialogComponent } from './core/components/dialog/order-dialog/order-dialog.component';




@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    CoreModule,
    MaterialModule,
    AppRoutingModule,
    HomeModule,
    BrowserAnimationsModule,
    FestivalModule,
    TicketModule,
    AccountModule,
    AuthModule,
    TickettypeModule,
    CheckoutModule,
    ContactModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: SwappitInterceptor,
      multi: true
    },
  ],
  bootstrap: [
    AppComponent
  ],
  entryComponents: [
    TicketDialogComponent,
    OrderDialogComponent
  ],
})
export class AppModule { }
