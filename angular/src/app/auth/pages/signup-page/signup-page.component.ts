import { Component, OnInit } from '@angular/core';
import { SwappitAuthService } from '../../../core/services/swappit-auth.service';
import { User } from '../../../core/models/user';
import { FormGroup, FormControl, Validators, FormBuilder } from '@angular/forms';
import { HttpErrorResponse } from '@angular/common/http';
import { Router } from '@angular/router';

@Component({
  selector: 'app-signup-page',
  templateUrl: './signup-page.component.html',
  styleUrls: ['./signup-page.component.scss']
})
export class SignupPageComponent implements OnInit {

  signUpForm: FormGroup;
  nameError: String = 'Name field is required.';
  emailError: String = 'Please enter a valid email';
  passwordError: String = 'Password field is required';
  passwordConfirmError: String = 'Password field is required';
  formSubmitted: boolean = false;
  submitErrors = {
    email: String,
    password: String,
  };

  constructor(private _swappitAuthService: SwappitAuthService, private fb: FormBuilder, private _router: Router) { 
    this.signUpForm = fb.group({
      'name': [null, Validators.required],
      'email': [null, [Validators.required, Validators.email]],
      'password': [null, Validators.required],
      'password_confirm': [null, Validators.required], 
      'validate': ''
    })
  }

  ngOnInit() {
  }

  onSubmit(values) {
    this.formSubmitted = true;
    this._swappitAuthService.signUp(values.name, values.email, values.password, values.password_confirm).subscribe(data => {
      console.log(data);
      this._router.navigate(['/verify-email']);
    },
    (err: HttpErrorResponse) => {
      if (err.error instanceof ErrorEvent) {
        console.log('Client-side error');
      } else {
        console.log('Server-side error.');
        this.submitErrors.email = err.error.errors.email;
        this.submitErrors.password = err.error.errors.password;
      }
      console.log(err);
    },
      () => console.log('Succesfully created account.'));
  }
}
