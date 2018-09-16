import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent, HttpErrorResponse, HttpResponse } from "@angular/common/http";
import { SwappitAuthService } from "../services/swappit-auth.service";
import { Observable } from "rxjs/Observable";
import { Injectable } from "@angular/core";
import 'rxjs/add/operator/do';
import 'rxjs/add/operator/catch';
import { Router } from "@angular/router";

@Injectable()
export class SwappitInterceptor implements HttpInterceptor {
  constructor(private _swappitAuthService: SwappitAuthService, private _router: Router) { }
  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    request = request.clone({
      setHeaders: {
        Authorization: `Bearer ${this._swappitAuthService.getAccessToken()}`
      }
    });
    return next.handle(request).do((event: HttpEvent<any>) => {
      if (event instanceof HttpResponse) {
        // do stuff with response if you want
      }
    }, (err: any) => {
      if (err instanceof HttpErrorResponse) {
        switch (err.status) {
          case 400:
            return false;
          case 401:
            return this._router.navigate(['signin']);
          case 404:
            return this._router.navigate(['404']);
        }
      }
    });
  }
}
