import { Injectable } from '@angular/core';
import { SwappitAuthService } from './swappit-auth.service';
import { Router, CanActivate } from '@angular/router';

@Injectable()
export class SwappitAuthGuardService implements CanActivate{

  constructor(private _swappitAuthService: SwappitAuthService, private _router: Router) { }

  canActivate(): boolean {
    if (!this._swappitAuthService.isAuthenticated()) {
      this._router.navigate(['signin']);
      return false;
    }
    return true;
  }

}
