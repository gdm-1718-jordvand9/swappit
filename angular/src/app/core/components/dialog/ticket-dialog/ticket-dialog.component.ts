import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';
import { SwappitService } from '../../../services/swappit.service';
import { Router } from '@angular/router';
import { HttpErrorResponse } from '@angular/common/http';

@Component({
  selector: 'app-ticket-dialog',
  templateUrl: './ticket-dialog.component.html',
  styleUrls: ['./ticket-dialog.component.scss']
})
export class TicketDialogComponent implements OnInit {

  constructor(private _swappitService: SwappitService, private _router: Router, private _dialogRef: MatDialogRef<TicketDialogComponent>, @Inject(MAT_DIALOG_DATA) private data: any) { }

  error: String;

  ngOnInit() {
  }

  closeDialog() {
    this._dialogRef.close();
  }
  setTicketTogglePublished(id: string) {
    this._swappitService.setTicketTogglePublished(id).subscribe(
      data => {
        this._dialogRef.close('published');
      },
      err => console.log(err),
      () => console.log('Successfully updated published.')
    )
  }

  setTicketBump(id: string) {
    this._swappitService.setTicketBump(id).subscribe(
      data => {
        console.log(data);
        this._dialogRef.close();
      }, (err: HttpErrorResponse) => {
        if (err.error instanceof ErrorEvent) {
          console.log('Client-side error');
        } else {
          console.log('Server-side error.');
          this.error = err.error;
        }
        console.log(err);
      },
    )
  }


}
