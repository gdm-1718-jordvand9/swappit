import { Component, OnInit } from '@angular/core';
import { SwappitService } from '../../../core/services/swappit.service';
import { Ticket } from '../../../core/models/ticket';
import { PaginationService } from '../../../core/services/pagination.service';
import { MatDialog } from '@angular/material';
import { TicketDialogComponent } from '../../../core/components/dialog/ticket-dialog/ticket-dialog.component';
import { Router } from '@angular/router';

@Component({
  selector: 'app-account-tickets',
  templateUrl: './account-tickets.component.html',
  styleUrls: ['./account-tickets.component.scss']
})
export class AccountTicketsComponent implements OnInit {

  tickets: Array<Ticket>;
  pagination: any;
  loading: boolean = true;

  constructor(private _swappitService: SwappitService, private _paginationService: PaginationService, private _dialog: MatDialog, private _router: Router) { }

  ngOnInit() {
    this.getAccountTickets();
  }

  getAccountTickets(): void {
    this._swappitService.getAccountTickets().subscribe(
      data => {
        console.log(data);
        this.tickets = data.data;
        this.pagination = this.getPagination(data.links, data.meta);
        this.loading = false;
      },
      err => console.log(err),
      () => console.log('Accouttickets successfully fetched.')
    )
  }

  getAccountTicketsByPage(url: string): void {
    this._swappitService.getAccountTicketsByPage(url).subscribe(
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

  openDialog(ticketId): void {
    const ticketObj = this.tickets.find(x => x.id === ticketId);
    console.log(ticketObj);
    let dialogRef = this._dialog.open(TicketDialogComponent, {
      width: '700px',
      data: ticketObj
    });
    dialogRef.afterClosed().subscribe(data => {
      if (data === 'published') {
        this.getAccountTicketsByPage(`${this._paginationService.pagination_meta.path}/?page=${this._paginationService.pagination_meta.current_page}`);
      }
    });
  }

  navigate() {
    this._router.navigate(['account/tickets/create']);
  }

}
