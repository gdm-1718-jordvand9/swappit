import { Injectable } from '@angular/core';
import { MatSidenav } from '@angular/material';

@Injectable()
export class SidenavService {
  public cartSidenav: MatSidenav;
  public menuSideNav: MatSidenav;
  constructor() { }

  public setCartSideNav(sidenav: MatSidenav) {
    this.cartSidenav = sidenav;
  }
  public setMenuSideNav(sidenav: MatSidenav) {
    this.menuSideNav = sidenav;
  }
  public openMenuSideNav() {
    return this.menuSideNav.open();
  }
  public openCartSideNav() {
    return this.cartSidenav.open();
  }
  public closeCartSideNav() {
    return this.cartSidenav.close();
  }
  public closeMenuSideNav() {
    return this.menuSideNav.close();
  }
  public toggleCartSideNav() {
    return this.cartSidenav.toggle();
  }
  public toggleMenuSideNav() {
    return this.menuSideNav.toggle();
  }

}
