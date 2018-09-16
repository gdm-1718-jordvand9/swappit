import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SigninPageComponent } from './pages/signin-page/signin-page.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { SignupPageComponent } from './pages/signup-page/signup-page.component';
import { VerifyEmailPageComponent } from './pages/verify-email-page/verify-email-page.component';
import { RouterModule } from '@angular/router';
import { VerifiedEmailPageComponent } from './pages/verified-email-page/verified-email-page.component';

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    FormsModule,
    RouterModule
  ],
  declarations: [
    SigninPageComponent,
    SignupPageComponent,
    VerifyEmailPageComponent,
    VerifiedEmailPageComponent
  ],
  exports: [
    SigninPageComponent,
  ]
})
export class AuthModule { }
