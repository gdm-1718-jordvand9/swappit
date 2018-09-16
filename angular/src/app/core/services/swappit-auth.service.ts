import { Injectable } from '@angular/core';
import { Router } from '@angular/router';

/*
Settings
*/
import { environment } from '../../../environments/environment';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { User } from '../models/user';

@Injectable()
export class SwappitAuthService {

  user: User;

  constructor(private _httpClient: HttpClient, private _router: Router) { }

  private _apiEndPointSignIn = `${environment.SwappitAuthApi.url}${environment.SwappitAuthApi.endPoints["oauth/token"]}`
  private _apiEndPointSignUp = `${environment.SwappitApi.url}${environment.SwappitAuthApi.endPoints.signup}`
  private _apiClientSecret = `${environment.SwappitAuthApi.clientSecret}`

  signIn(username, password) {
    let postData = {
      grant_type: 'password',
      client_id: 1,
      client_secret: `${this._apiClientSecret}`,
      username: username,
      password: password,
    }
    return this._httpClient.post<any>(`${this._apiEndPointSignIn}`, postData);
  }

  signUp(name, email, password, password_confirm) {
    let postData = {
      email: email,
      name: name,
      password: password,
      password_confirmation: password_confirm,
    }
    return this._httpClient.post<any>(`${this._apiEndPointSignUp}`, postData);
  }

  signOut(): void {
    localStorage.removeItem('access_token');
    this._router.navigate(['signin']);
  }

  isAuthenticated(): boolean {
    const token = localStorage.getItem('access_token');
    if (token) {
      return true;
    } else {
      return false;
    }
  }
  getAccessToken(): string {
    return localStorage.getItem('access_token');
  }

}
