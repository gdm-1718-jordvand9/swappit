import { Component, OnInit } from '@angular/core';
import { Festival } from '../../../core/models/Festival';
import { SwappitService } from '../../../core/services/swappit.service';
import { TicketType } from '../../../core/models/ticket-type';
import { Ticket } from '../../../core/models/ticket';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { HttpErrorResponse } from '@angular/common/http';

@Component({
  selector: 'app-account-tickets-create',
  templateUrl: './account-tickets-create.component.html',
  styleUrls: ['./account-tickets-create.component.scss'],
})
export class AccountTicketsCreateComponent implements OnInit {

  ticketCreateForm: FormGroup;
  festivalError: String = 'Festival field is required.';
  ticket_typeError: String = 'Ticket Type field is required.';
  start_dateError: String = 'Start date field is required.';
  end_dateError: String = 'End date field is required.';
  priceError: String = 'Price field is required.';
  codeError: String = 'Code field is required.';

  constructor(private _swappitService: SwappitService, private fb: FormBuilder, private _router: Router) {
    this.ticketCreateForm = fb.group({
      'festival': [null, Validators.required],
      'ticket_type': [null, Validators.required],
      'start_date': [null, Validators.required],
      'end_date': [null, Validators.required],
      'price': [null, Validators.required],
      'code': [null, Validators.required],
      'published': [null],
      'validate': ''
    });
    // this.ticketCreateForm.controls['festival'].setValue('Select a festival first', {onlySelf: true});
  }


  festivalsVM: Array<object>;
  ticket_typesVM: Array<object>;
  ticket = new Ticket();
  ticket_type_info: any;
  formSubmitted: boolean = false;
  submitErrors = {
    ticket_type: String,
    start_date: String,
    end_date: String,
    price: String,
    code: String,
  };



  ngOnInit() {
    this.getVMFestival();
  }
  onSubmit(values) {
    this.formSubmitted = true;
    console.log(values);
    let ticket = new Ticket();
    ticket.code = values.code;
    ticket.price = values.price;
    ticket.end_date = values.end_date;
    ticket.start_date = values.start_date;
    ticket.published = values.published ? values.published : 0;
    ticket.ticket_type.id = values.ticket_type;
    //ticket.ticket_type.festival = values.festival;

    this._swappitService.setTicket(ticket).subscribe(
      data => {
        console.log(data);
        this._router.navigate(['/account/tickets']);
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof ErrorEvent) {
          console.log('Client-side error');
        } else {
          console.log('Server-side error.');
          this.submitErrors.ticket_type = err.error.errors.email;
          this.submitErrors.start_date = err.error.errors.start_date;
          this.submitErrors.end_date = err.error.errors.end_date;
          this.submitErrors.price = err.error.errors.price;
          this.submitErrors.code = err.error.errors.code;
        }
        console.log(err);
      },
      () => console.log('Ticket submitted successfully.'),
    )
  }
  getVMFestival() {
    this._swappitService.getVMFestivals().subscribe(
      data => {
        this.festivalsVM = Object.keys(data).map(id => ({ id, name: data[id] }));
        console.log(this.festivalsVM);
      },
      err => console.log(err),
      () => console.log('Festival VM fetched successfully.')
    )
  }

  getVMTicketType(festivalId: string) {
    this._swappitService.getVMTicketType(festivalId).subscribe(
      data => {
        this.ticket_typesVM = Object.keys(data).map(id => ({ id, name: data[id] }));
        console.log(this.ticket_typesVM);
      },
      err => console.log(err),
      () => console.log('VMTicketType succesfully fetched.')
    )
  }

  getVMTicketTypeInfo(id: string) {
    console.log(id);
    if (id) {
      this._swappitService.getVMTicketTypeInfo(id).subscribe(
        data => {
          this.ticket_type_info = data;
          console.log(this.ticket_type_info);
        },
        err => console.log(err),
        () => console.log('VMTicketTypeInfo successfully fetched.')
      )
    }

  }

  setTicket() {
    console.log(this.ticket);
    this._swappitService.setTicket(this.ticket).subscribe(
      data => {
        console.log(data);
      },
      err => console.log(err),
      () => console.log('Ticket submitted successfully.'),
    )
  }
  onChange(id: string) {
    this.ticket_type_info = null;
    if(id) {
      this.getVMTicketType(id);
    }
  }
}
