import { Component, ViewChild } from '@angular/core';
import { MatSidenav } from '@angular/material';
import { SidenavService } from './core/services/sidenav.service';

//
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  @ViewChild('cartSideNav') public cartSideNav: MatSidenav;
  @ViewChild('menuSideNav') public menuSideNav: MatSidenav;
  title = 'app';
  constructor(private _sidenavService: SidenavService) {}

  ngOnInit(): void {
    this._sidenavService.setCartSideNav(this.cartSideNav);
    this._sidenavService.setMenuSideNav(this.menuSideNav)
  }
}

