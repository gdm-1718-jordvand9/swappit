import { Component, OnInit } from '@angular/core';
import { SwappitService } from '../../../core/services/swappit.service';
import { Ticket } from '../../../core/models/ticket';
import { Router } from '@angular/router';
import { HttpErrorResponse } from '@angular/common/http';
import { PaginationService } from '../../../core/services/pagination.service';
import { CartService } from '../../../core/services/cart.service';
import { ParameterService } from '../../../core/services/parameter.service';

@Component({
  selector: 'app-ticket-list',
  templateUrl: './ticket-list.component.html',
  styleUrls: ['./ticket-list.component.scss']
})
export class TicketListComponent implements OnInit {

  tickets: Array<Ticket>;
  pagination: any;
  festivalSort: String;
  priceSort: String;
  loading: boolean = true;

  constructor(private _swappitService: SwappitService,
    private _paginationService: PaginationService,
    private _cartService: CartService,
    private _router: Router,
    private _parameterService: ParameterService) { }

  ngOnInit() {
    this.getTickets();
    let params = this._parameterService.getParametersFromUrl();
    if(params.sort === 'price') this.priceSort = params.type;
    if(params.sort === 'ticket_type_id') this.festivalSort = params.type;

  }

  getTickets() {
    this.loading = true;
    this.tickets = undefined;
    this._swappitService.getTickets().subscribe(
      data => {
        console.log(data);
        this.tickets = data.data;
        this.pagination = this.getPagination(data.links, data.meta);
        console.log(this.pagination.meta);
        this.loading = false;
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof ErrorEvent) {
          console.log('Client-side error');
        } else {
          console.log('Server-side error.');
        }
        if (err.status === 404) {
          this._router.navigate(['404'])
        }
        console.log(err);
        console.log(err.status);
      },
      () => console.log('Tickets fetched successfully.')
    )
  }

  getTicketsByPage(url: string) {
    this._swappitService.getTicketsByPage(url).subscribe(
      data => {
        console.log(data);
        this.tickets = data.data;
        this.pagination = this.getPagination(data.links, data.meta);
      },
      err => console.log(err),
      () => console.log('Tickets by page successfully fetched.')
    )
  }

  getPagination(links, meta) {
    return this._paginationService.getPagination(links, meta);
  }

  addToCart(ticket: Ticket) {
    console.log(ticket);
    this._cartService.addItem(ticket);
  }

  sort(sort: string, type: string) {
    if(sort === 'price') {
      this.priceSort = type;
      this.festivalSort = null;
    }
    if(sort === 'ticket_type_id') {
      this.festivalSort = type;
      this.priceSort = null;
    }
    console.log(this.priceSort);
    this._router.navigate([], { queryParams: { 'sort': sort, 'type': type } }).then(() => {
      this.getTickets();
    });
  }

}
