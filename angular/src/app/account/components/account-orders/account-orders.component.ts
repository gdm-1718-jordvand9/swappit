import { Component, OnInit } from '@angular/core';
import { SwappitService } from '../../../core/services/swappit.service';
import { Order } from '../../../core/models/order';
import { MatDialog } from '@angular/material';
import { OrderDialogComponent } from '../../../core/components/dialog/order-dialog/order-dialog.component';
import { PaginationService } from '../../../core/services/pagination.service';

@Component({
  selector: 'app-account-orders',
  templateUrl: './account-orders.component.html',
  styleUrls: ['./account-orders.component.scss']
})
export class AccountOrdersComponent implements OnInit {

  private orders: Array<Order>;
  private order: Order;
  private pagination: any;

  constructor(private _swappitService: SwappitService, private _dialog: MatDialog, private _paginationService: PaginationService) { }

  ngOnInit() {
    this.getAccountOrders();
  }
  getAccountOrders() {
    this._swappitService.getAccountOrders().subscribe(
      data => {
        this.orders = data.data;
        console.log(data);
        this.pagination = this.getPagination(data.links, data.meta);
      }
    )
  }
  getAccountOrdersByPage(url: string): void {
    this._swappitService.getAccountOrdersByPage(url).subscribe(
      data => {
        console.log(data);
        this.orders = data.data;
        this.pagination = this.getPagination(data.links, data.meta);
      },
      err => console.log(err),
      () => console.log('Tickets by page successfully fetched.')
    )
  }

  getAccountOrderById(id: string){
    
  }
  openDialog(id: string) {
    this._swappitService.getAccountOrderById(id).subscribe(
      data => {
        let dialogRef= this._dialog.open(OrderDialogComponent, { 
          width: '700px',
          data: data
        });
        dialogRef.afterClosed();
      }
    )
  }
  getPagination(links, meta) {
    return this._paginationService.getPagination(links, meta);
  }

}
