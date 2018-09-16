import { Component, OnInit } from '@angular/core';
import { SwappitService } from '../../../core/services/swappit.service';
import { User } from '../../../core/models/user';
import { SwappitAuthService } from '../../../core/services/swappit-auth.service';
import { HttpErrorResponse } from '@angular/common/http';
import { Router } from '@angular/router';

@Component({
  selector: 'app-account-settings',
  templateUrl: './account-settings.component.html',
  styleUrls: ['./account-settings.component.scss']
})
export class AccountSettingsComponent implements OnInit {

  user: User;

  constructor(private _swappitService: SwappitService, private _swappitAuthService: SwappitAuthService, private _router: Router) { }

  ngOnInit() {
    this.getAccount();
  }

  getAccount() {
    this._swappitService.getAccount().subscribe(
      data => {
        console.log(data);
        this.user = data;
      },
      (err: HttpErrorResponse) => {
        if(err.error instanceof ErrorEvent)
        {
          console.log('Client-side error');
        } else {
          console.log('Server-side error.');  
        }
        if(err.status === 401) {
          localStorage.removeItem('access_token');
          this._router.navigate(['signin']);
        }
        console.log(err);
        //console.log(err.status);
      },
      () => console.log('Account fetched successfully.')
    )
  }

  setAccount() {
    this._swappitService.setAccount(this.user.name, this.user.email).subscribe(
      data => {
        console.log(data);
      },
      err => console.log(err),
      () => console.log('Account successfully updated.')
    )
  }

  signOut() {
    this._swappitAuthService.signOut();
  }

}
