import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';
import { Router } from '@angular/router';
import { CheckoutService } from '../../../../checkout/services/checkout.service';

@Component({
  selector: 'app-order-dialog',
  templateUrl: './order-dialog.component.html',
  styleUrls: ['./order-dialog.component.scss']
})
export class OrderDialogComponent implements OnInit {

  constructor(private _router: Router, private _checkoutService: CheckoutService, private _dialogRef: MatDialogRef<OrderDialogComponent>, @Inject(MAT_DIALOG_DATA) private data: any) { }

  ngOnInit() {
  }

  closeDialog() {
    this._dialogRef.close();
  }
  payOrder(id: string) {
    this._router.navigate(['checkout/order/', id]);
    this.closeDialog();
  }

}
