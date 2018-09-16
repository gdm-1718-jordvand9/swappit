import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AccountSettingsComponent } from './components/account-settings/account-settings.component';
import { AccountTicketsComponent } from './components/account-tickets/account-tickets.component';
import { AccountOrdersComponent } from './components/account-orders/account-orders.component';
import { AccountPageComponent } from './pages/account-page/account-page.component';
import { AppRoutingModule } from '../app-routing.module';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { AccountTicketsCreateComponent } from './components/account-tickets-create/account-tickets-create.component';
import { AccountTicketsEditComponent } from './components/account-tickets-edit/account-tickets-edit.component';

@NgModule({
  imports: [
    CommonModule,
    AppRoutingModule,
    ReactiveFormsModule,
    FormsModule
  ],
  declarations: [
    AccountSettingsComponent,
    AccountTicketsComponent, 
    AccountOrdersComponent, 
    AccountPageComponent, 
    AccountTicketsCreateComponent, 
    AccountTicketsEditComponent,
  ],
  exports: [
    AccountPageComponent,
  ]
})
export class AccountModule { }
