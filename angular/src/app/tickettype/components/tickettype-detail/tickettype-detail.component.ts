import { Component, OnInit } from '@angular/core';
import { SwappitService } from '../../../core/services/swappit.service';
import { ActivatedRoute } from '@angular/router';
import { TicketType } from '../../../core/models/ticket-type';
import { Ticket } from '../../../core/models/ticket';
import { Festival } from '../../../core/models/Festival';
import { CartService } from '../../../core/services/cart.service';
import { HttpErrorResponse } from '@angular/common/http';

@Component({
  selector: 'app-tickettype-detail',
  templateUrl: './tickettype-detail.component.html',
  styleUrls: ['./tickettype-detail.component.scss']
})
export class TickettypeDetailComponent implements OnInit {

  constructor(private _swappitService: SwappitService, private _cartService: CartService, private _route: ActivatedRoute) { }

  tickettype: TicketType;
  tickets: Array<Ticket>;
  festival: Festival;
  loading: boolean = true;
  tickettype_wanted_message: any;

  ngOnInit() {
    const id = this._route.snapshot.params['id'];
    this.getTicketTypeById(id);
  }

  getTicketTypeById(id: string) {
    this._swappitService.getTicketTypeById(id).subscribe(
      data => {
        console.log(data);
        this.tickettype = data;
        this.tickets = this.tickettype.tickets;
        this.festival = this.tickettype.festival;
        this.loading = false;
      },
      err => console.log(err),
      () => console.log('TicketType succesfully fetched.')
    )
  }
  
  setTicketTypeWant() {
    this._swappitService.setTicketTypeWant(this.tickettype.id).subscribe(
      data => {
        this.tickettype_wanted_message = data;
        this.tickettype.tickets_wanted_count += 1;
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof ErrorEvent) {
          console.log('Client-side error');
        } else {
          console.log('Server-side error.');
        }
        if (err.status === 406) {
          this.tickettype_wanted_message = err.error;
        }
        console.log(err);

      },
    )
  }

  addToCart(ticket: Ticket) {
    ticket.ticket_type = this.tickettype;
    this._cartService.addItem(ticket);
  }

}
