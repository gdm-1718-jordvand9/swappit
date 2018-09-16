import { Component, OnInit } from '@angular/core';
import { SwappitAuthService } from '../../../core/services/swappit-auth.service';
import { User } from '../../../core/models/user';
import { HttpErrorResponse } from '@angular/common/http';
import { Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-signin-page',
  templateUrl: './signin-page.component.html',
  styleUrls: ['./signin-page.component.scss']
})
export class SigninPageComponent implements OnInit {

  signInForm: FormGroup;
  emailError: String = 'Email field is required.';
  passwordError: String = 'Password field is required';
  error: String;

  constructor(private _swappitAuthSerive: SwappitAuthService, private fb: FormBuilder, private _router: Router) { 
    this.signInForm = fb.group({
      'email': [null, [Validators.required, Validators.email]],
      'password': [null, Validators.required],
      'validate': ''
    })
  }

  ngOnInit() {
  }

  onSubmit(values) {
    this._swappitAuthSerive.signIn(values.email, values.password).subscribe(
      data => {
        console.log(data);
        localStorage.removeItem('access_token');
        localStorage.setItem('access_token', data.access_token);
        this._router.navigate(['account']);
      },
      (err: HttpErrorResponse) => {
        if (err.error instanceof ErrorEvent) {
          console.log('Client-side error');
        } else {
          console.log('Server-side error.');
          this.error = err.error.message;
        }
        console.log(err);
      },
      () => console.log('Token received successfully.')
    )
  }

}
