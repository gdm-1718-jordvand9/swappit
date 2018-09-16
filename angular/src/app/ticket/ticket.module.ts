import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TicketDetailComponent } from './components/ticket-detail/ticket-detail.component';
import { TicketPageComponent } from './pages/ticket-page/ticket-page.component';
import { TicketsPageComponent } from './pages/tickets-page/tickets-page.component';
import { TicketListComponent } from './components/ticket-list/ticket-list.component';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [
    CommonModule,
    RouterModule
  ],
  declarations: [
    TicketDetailComponent,
    TicketPageComponent,
    TicketsPageComponent,
    TicketListComponent
  ], exports: [
    TicketPageComponent,
    TicketsPageComponent
  ]
})
export class TicketModule { }
