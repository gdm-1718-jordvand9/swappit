import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

/*
Models
*/
import { Festival } from '../../../core/models/Festival';

/*
Services
*/
import { SwappitService } from '../../../core/services/swappit.service';
import { HttpErrorResponse } from '@angular/common/http';
import { ErrorObservable } from 'rxjs/observable/ErrorObservable';
import { TicketType } from '../../../core/models/ticket-type';


@Component({
  selector: 'app-festival-detail',
  templateUrl: './festival-detail.component.html',
  styleUrls: ['./festival-detail.component.scss']
})
export class FestivalDetailComponent implements OnInit {

  festival: Festival;
  loading: boolean = true;

  constructor(private _swappitService: SwappitService, private _route: ActivatedRoute, private _router: Router) { }

  ngOnInit() {
    const id = this._route.snapshot.params['id'];
    window.setTimeout(() => {
      this.getFestivalById(id);
    }, 1000);

  }

  getFestivalById(id: string) {
    this._swappitService.getFestivalById(id).subscribe(
      data => {
        this.festival = data;
        this.festival.ticket_types.forEach((ticket_type) => {
          this.festival.tickets_wanted_count += ticket_type.tickets_wanted_count;
          this.festival.tickets_available_count += ticket_type.tickets_available_count;
          this.festival.tickets_sold_count += ticket_type.tickets_sold_count;
        });
        console.log(data);
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
      () => {
        console.log('Successfully fetched festival.');
      }
    )
  }

  navigate(id) {
    this._router.navigate([`ticket_types/${id}`])
  }

}
